<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-graduation-cap"></i></h3>
			<h2>Adicionar módulos</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<span></span>
				<?php
					if(isset($_POST['acao'])){
						$nomemodulo = $_POST['nome_modulo'];
						$descricao = $_POST['descricao_modulo'];
						
						if($nomemodulo == ''){
							Painel::mensagem('erro','O nome do módulo não foi inserido.');
						}else if($descricao == ''){
							Painel::mensagem('erro','A descrição não foi inserida.');
						}else{
							$sql = MySql::conexaobd()->prepare("SELECT * FROM `modulos_curso` WHERE nome_modulo = ?");
							$sql->execute(array($nomemodulo));
							$informacao = $sql->fetch();
							if($sql->rowCount() == 0){
								$envio = array('nome_modulo'=>$nomemodulo,'descricao_modulo'=>$descricao,'inserir'=>'modulos_curso');
								Painel::inseririnformacoes($envio);
								Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'modulo?sucesso');
							}else{
								Painel::mensagem('erro','Esse módulo já existe!');
							}
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['acao']))
						Painel::mensagem('sucesso','Cadastro realizado com sucesso!');
				?>
			<div>
				<p>Nome do módulo:</p>
				<input type="text" name="nome_modulo" value="<?php echo Painel::recuperarcampopreenchido('nome_modulo');?>">
			</div>
			<div>
				<p>Descrição do módulo:</p>
				<textarea class="tinymce" name="descricao_modulo"></textarea>
			</div>
			<div>
				<input type="hidden" name="inserir" value="modulos_curso">
				<input type="submit" name="acao" value="Adicionar">
			</div>
		</form>
		</div>
	</div>
</section>