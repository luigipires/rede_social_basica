<?php
	permissao(0);
?>
<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-user-plus"></i></h3>
			<h2>Adicionar usuário</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<?php
					if(isset($_POST['acao'])){
						$nome_usuario = $_POST['nome_usuario'];
						$nome = $_POST['nome'];
						$sobrenome = $_POST['sobrenome'];
						$senha = $_POST['senha'];
						$fotoperfil = $_FILES['foto_perfil'];
						$tipousuario = $_POST['tipo_usuario'];
						
						if($nome_usuario == ''){
							Painel::mensagem('erro','O nome de usuário não foi inserido.');
						}else if($nome == ''){
							Painel::mensagem('erro','O nome não foi inserido.');
						}else if($sobrenome == ''){
							Painel::mensagem('erro','O sobrenome não foi inserido.');
						}else if($senha == ''){
							Painel::mensagem('erro','A senha não foi inserida.');
						}else if($fotoperfil['name'] == ''){
							Painel::mensagem('erro','Você precisa carregar uma foto.');
						}else{
							if(Painel::validacaoimagem($fotoperfil) == false){
								Painel::mensagem('erro','O formato da imagem não é válido.');
							}else if($tipousuario <= $_SESSION['tipo_usuario']){
								Painel::mensagem('erro','O cargo a ser atribuido precisa ser menor do que o seu!');
							}else{
								$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios_site` WHERE nome_usuario = ?");
								$sql->execute(array($nome_usuario));
								$informacao = $sql->fetch();
								if($sql->rowCount() == 0){
									$uparimagem = Painel::uparimagem($fotoperfil);
									$envio = array('nome_usuario'=>$nome_usuario,'nome'=>$nome,'sobrenome'=>$sobrenome,'senha'=>$senha,'foto_perfil'=>$uparimagem,'tipo_usuario'=>$tipousuario,'inserir'=>'usuarios_site');
									Painel::inseririnformacoes($envio);
									Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'adicionar-usuario?sucesso');
								}else{
									Painel::mensagem('erro','Esse usuário já existe!');
								}
							}
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['acao']))
						Painel::mensagem('sucesso','Cadastro realizado com sucesso!');
				?>
			<div>
				<p>Nome de usuário:</p>
				<input type="text" name="nome_usuario">
			</div>
			<div>
				<p>Nome:</p>
				<input type="text" name="nome">
			</div>
			<div>
				<p>Sobrenome:</p>
				<input type="text" name="sobrenome">
			</div>
			<div>
				<p>Senha:</p>
				<input type="password" name="senha">
			</div>
			<div>
				<p>Foto de perfil:</p>
				<input type="file" id="file" name="foto_perfil">
			</div>
			<div>
				<p>Tipo de usuário:</p>
					<select name="tipo_usuario">
						<?php
							foreach (Painel::$tipousuario as $key => $value){
								if($key > $_SESSION['tipo_usuario'])
									echo '<option value="'.$key.'">'.$value.'</option>';
							}
						?>
					</select>
				</div>
			<div>
				<input type="hidden" name="inserir" value="usuarios_site">
				<input type="submit" name="acao" value="Adicionar">
			</div>
		</form>
		</div>
	</div>
</section>