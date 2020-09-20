<?php
	$user = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
	$user->execute(array($_SESSION['id']));
	$user = $user->fetchAll();
?>
<section>
	<div class="area-user">
		<div class="perfil">
			<aside>
				<div class="nome-user">
					<a href="<?php echo INCLUDE_PATH;?>perfil/<?php echo $_SESSION['nome'];?>">
						<h4><?php echo $_SESSION['nome'];?></h4>
					</a>
				</div>
				<?php
					if($_SESSION['fotoperfil'] != ''){
				?>
				<div class="foto-user">
					<img src="<?php echo INCLUDE_PATH;?>imagens/usuarios/<?php echo $_SESSION['fotoperfil'];?>">
				</div>
				<?php
					}else{
				?>
				<div class="no-foto-user">
					<h3><i class="fas fa-user"></i></h3>
				</div>
				<?php
					}
				?>
				<div class="lista-amigos">
					<h3><i class="fas fa-users"></i></h3>
					<h2>Amigos (<?php echo count(\models\amigosModel::listaramigos());?>)</h2>
				</div>
				<?php
					$amigos = \models\amigosModel::listaramigos();
					foreach ($amigos as $key => $value){
						$amigouser = \models\amigosModel::pegaridamigo($value);
				?>
				<div class="amigos-user">
					<a href="<?php echo INCLUDE_PATH;?>perfil/<?php echo $amigouser['nome'];?>">
						<img src="<?php echo INCLUDE_PATH;?>imagens/usuarios/<?php echo $amigouser['fotoperfil'];?>">
					</a>
				</div>
				<?php
					}
				?>
				<div class="clear"></div>
			</aside>
		</div>
		<div class="feed-news">
			<div class="feed-config">
				<div class="status">
					<h2>Você tem alguma coisa a dizer?</h2>
					<form class="ajax" action="<?php echo INCLUDE_PATH;?>ajax/postagens.php" method="post" enctype="multipart/form-data">
						<div>
							<input placeholder="Título..." type="text" name="titulo" value="<?php echo Painel::recuperarcampopreenchido('titulo');?>">
						</div>
						<div>
							<textarea placeholder="Mensagem..." name="conteudo"><?php echo Painel::recuperarcampopreenchido('conteudo');?></textarea>
						</div>
						<div>
							<input multiple type="file" name="fotoconteudo[]">
						</div>
						<div>
							<input type="submit" name="feed" value="Postar">
						</div>
					</form>
				</div>
				<?php
					$postagens = \MySql::conexaobd()->prepare("SELECT * FROM `feed`");
					$postagens->execute();
					$postagens = $postagens->fetchAll();

					foreach ($postagens as $key2 => $value2){
						$postsamigos = \models\amigosModel::pegaridamigo($value2['usuario_id']);
						$imagempost = \MySql::conexaobd()->prepare("SELECT * FROM `imagempost` WHERE feed_id = ?");
						$imagempost->execute(array($value2['id']));
						$imagempost = $imagempost->fetch();
				?>
				<div class="conteudo-feed">
						<a href="<?php echo INCLUDE_PATH;?>perfil/<?php echo $postsamigos['nome'];?>">
							<div class="info-user">
								<div class="foto-user-post">
									<img src="<?php echo INCLUDE_PATH;?>imagens/usuarios/<?php echo $postsamigos['fotoperfil'];?>">
								</div>
								<div class="info-user-content">
									<p><?php echo ucfirst($postsamigos['nome']); ?></p>
								</div>
								<div class="clear"></div>
							</div>
						</a>
					<div class="conteudo-user">
						<div class="conteudo-user-post">
							<h4><?php echo ucfirst($value2['titulo']);?></h4>
							<p><?php echo ucfirst($value2['conteudo']);?></p>
						</div>
						<div class="foto-conteudo">
							<?php 
								if(isset($imagempost['foto_conteudo'])){
							?>
								<img src="<?php echo INCLUDE_PATH;?>imagens/feed/<?php echo $imagempost['foto_conteudo'];?>">
							<?php
								}else{
							?>
								<div></div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</section>