<?php
	if(isset($_GET['deslogado'])){
		Painel::signout();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/stefangabos/Zebra_Datepicker/dist/css/default/zebra_datepicker.min.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/jquery-ui.min.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/fontawesome.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/brands.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/solid.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/stylehome.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<title>Área do cliente</title>
</head>
<body>
	<base base="<?php echo INCLUDE_PATH_PAINEL; ?>"></base>
	<div class="box-home">
		<aside>
			<div class="info-usuario">
				<div class="foto-usuario">
					<?php
						if($_SESSION['foto_perfil'] == ''){
					?>
					<div class="foto-anonimo">
						<h3><i class="fas fa-user"></i></h3>
					</div>
					<?php
						}else{
					?>
					<div class="foto-real">
						<img src="<?php echo INCLUDE_PATH_PAINEL;?>imagens/uploads/<?php echo $_SESSION['foto_perfil'];?>">
					</div>
					<?php
						}
					?>
				</div>
				<div class="nome-usuario">
					<p><?php echo $_SESSION['nome'];?></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="menus">
				<div class="menus-group">
					<ul>
						<li>
							<div class="i02">
								<a href="<?php echo INCLUDE_PATH;?>">
									<h3><i class="fas fa-home"></i></h3>
									<p>Voltar à página inicial</p>
								</a>
							</div>
						</li>
						<li>
							<h2>Editar informações</h2>
							<div <?php destaque('editar-usuario');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>editar-usuario">
									<h3><i class="fas fa-user-edit"></i></h3>
									<p>Editar usuário</p>
								</a>
							</div>
							<div <?php verificacaopermissao(0);?> <?php destaque('adicionar-usuario');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-usuario">
									<h3><i class="fas fa-user-plus"></i></h3>
									<p>Adicionar usuário</p>
								</a>
							</div>
						</li>
						<li>
							<h2>Ensino à distância</h2>
							<div <?php destaque('adicionar-aluno');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-aluno">
									<h3><i class="fas fa-graduation-cap"></i></h3>
									<p>Adicionar aluno</p>
								</a>
							</div>
							<div <?php verificacaopermissao(0);?> <?php destaque('modulo');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>modulo">
									<h3><i class="fas fa-graduation-cap"></i></h3>
									<p>Adicionar módulos</p>
								</a>
							</div>
							<div <?php verificacaopermissao(0);?> <?php destaque('adicionar-aula');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-aula">
									<h3><i class="fas fa-graduation-cap"></i></h3>
									<p>Adicionar aulas</p>
								</a>
							</div>
						</li>
						<li>
							<h2>Site</h2>
							<div <?php destaque('adicionar-propagandas');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-propagandas">
									<h3><i class="fas fa-images"></i></h3>
									<p>Adicionar fotos</p>
								</a>
							</div>
							<div <?php destaque('lista-propagandas');?> >
								<a href="<?php echo INCLUDE_PATH_PAINEL;?>lista-propagandas">
									<h3><i class="fas fa-images"></i></h3>
									<p>Listagem de fotos</p>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</aside>
		<header>
			<h3><i class="fas fa-bars"></i></h3>
			<div class="sair">
				<a href="<?php echo INCLUDE_PATH_PAINEL;?>?deslogado">
					<h3><i class="fas fa-sign-out-alt"></i></h3>
					<p>Sair</p>
				</a>
			</div>
			<div class="voltar-home">
				<a href="<?php echo INCLUDE_PATH;?>">Voltar à página inicial</a>
			</div>
			<div class="clear"></div>
		</header>
		<div class="clear"></div>
	</div>
	<div class="php">
		<?php 
			Painel::carregarpagina();
		?>
	</div>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/jquery.js"></script>
	<?php Painel::carregarjavascript(array('jquery-ui.min.js'),'lista-empreendimento');?>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/jquery.maskMoney.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/stefangabos/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/jquery.ajaxform.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/arquivo.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/ajax.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>javascript/constantes.js"></script>
	<?php Painel::carregarjavascript(array('ajax.js'),'adicionar-cliente');?>
	<?php Painel::carregarjavascript(array('ajax.js'),'lista-cliente');?>
	<?php Painel::carregarjavascript(array('ajax.js'),'editar-cliente');?>
	<?php Painel::carregarjavascript(array('pagamentos.js'),'editar-cliente');?>
	<?php Painel::carregarjavascript(array('jqueryUI.js'),'lista-empreendimento');?>
	<?php Painel::carregarjavascript(array('chat.js'),'chat');?>
	<?php Painel::carregarjavascript(array('calendario.js'),'calendario');?>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	<script>tinymce.init({selector:'.tinymce', plugin:"image", height:550});</script>
</body>
</html>
