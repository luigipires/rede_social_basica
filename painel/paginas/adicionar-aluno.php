<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-graduation-cap"></i></h3>
			<h2>Adicionar alunos</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<span></span>
				<?php
					if(isset($_POST['acao'])){
						$nome = $_POST['nome'];
						$email = $_POST['email'];
						$senha = $_POST['senha'];
						
						if($nome == ''){
							Painel::mensagem('erro','O nome não foi inserido.');
						}else if($email == ''){
							Painel::mensagem('erro','O e-mail não foi inserido.');
						}else if($senha == ''){
							Painel::mensagem('erro','A senha não foi inserida.');
						}else{
							$sql = MySql::conexaobd()->prepare("SELECT * FROM `alunos` WHERE nome = ?");
							$sql->execute(array($nome));
							$informacao = $sql->fetch();
							if($sql->rowCount() == 0){
								$envio = array('nome'=>$nome,'email'=>$email,'senha'=>$senha,'inserir'=>'alunos');
								Painel::inseririnformacoes($envio);
								Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'adicionar-aluno?sucesso');
							}else{
								Painel::mensagem('erro','Esse aluno já existe!');
							}
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['acao']))
						Painel::mensagem('sucesso','Cadastro realizado com sucesso!');
				?>
			<div>
				<p>Nome:</p>
				<input type="text" name="nome" value="<?php echo Painel::recuperarcampopreenchido('nome');?>">
			</div>
			<div>
				<p>E-mail:</p>
				<input type="email" name="email" value="<?php echo Painel::recuperarcampopreenchido('email');?>">
			</div>
			<div>
				<p>Senha:</p>
				<input type="password" name="senha" value="<?php echo Painel::recuperarcampopreenchido('senha');?>">
			</div>
			<div>
				<input type="hidden" name="inserir" value="alunos">
				<input type="submit" name="acao" value="Adicionar">
			</div>
		</form>
		</div>
	</div>
</section>