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
						$nomeaula = $_POST['nome_aula'];
						$moduloid = $_POST['modulo_id'];
						$linkaula = $_POST['link_aula'];
						
						if($nomeaula == ''){
							Painel::mensagem('erro','O nome da aula não foi inserido.');
						}else if($linkaula == ''){
							Painel::mensagem('erro','O link da aula não foi inserida.');
						}else{
							$sql = MySql::conexaobd()->prepare("SELECT * FROM `aulas` WHERE modulo_id = ?");
							$sql->execute(array($moduloid));
							$informacao = $sql->fetch();
							if($sql->rowCount() == 0){
								$envio = array('modulo_id'=>$moduloid,'nome_aula'=>$nomeaula,'link_aula'=>$linkaula,'inserir'=>'aulas');
								Painel::inseririnformacoes($envio);
								Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'adicionar-aula?sucesso');
							}else{
								Painel::mensagem('erro','Essa aula já existe!');
							}
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['acao']))
						Painel::mensagem('sucesso','Cadastro realizado com sucesso!');
				?>
			<div>
				<p>Selecione o módulo:</p>
				<select name="modulo_id">
					<?php
						$modulos = \MySql::conexaobd()->prepare("SELECT * FROM `modulos_curso`");
						$modulos->execute();
						$modulos = $modulos->fetchAll();
						foreach ($modulos as $key => $value){
					?>
						<option value="<?php echo $value['id'];?>"><?php echo $value['nome_modulo'];?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div>
				<p>Nome da aula:</p>
				<input type="text" name="nome_aula" value="<?php echo Painel::recuperarcampopreenchido('nome_aula');?>">
			</div>
			<div>
				<p>Link da aula:</p>
				<input type="text" name="link_aula" value="<?php echo Painel::recuperarcampopreenchido('link_aula');?>">
			</div>
			<div>
				<input type="hidden" name="inserir" value="aulas">
				<input type="submit" name="acao" value="Adicionar">
			</div>
		</form>
		</div>
	</div>
</section>