<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-user-edit"></i></h3>
			<h2>Editar usuário</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<?php
					if(isset($_POST['acao'])){
						$nomeusuario = $_POST['nome_usuario'];
						$nome = $_POST['nome'];
						$sobrenome = $_POST['sobrenome'];
						$senha = $_POST['senha'];
						$foto = $_FILES['foto_perfil'];
						$fotoatual = $_POST['fotoatual'];

						if($nomeusuario == ''){
							Painel::mensagem('erro','Você precisa colocar um nome de usuário.');
						}else if($nome == ''){
							Painel::mensagem('erro','Você precisa colocar o nome.');
						}else if($sobrenome == ''){
							Painel::mensagem('erro','Você precisa colocar o sobrenome.');
						}else if($senha == ''){
							Painel::mensagem('erro','Você precisa colocar uma senha.');
						}else if($foto['name'] != ''){
							if(Painel::validacaoimagem($foto) == false){
								Painel::mensagem('erro','O formato da imagem não é válido.');
							}else if(Usuarios::verificacaoedicao($nomeusuario)){
								Painel::mensagem('erro','Esse usuário já existe.');
							}else{
								//ver como salvar perfil sem ter conflito no nome de usuário
								$usuarios = new Usuarios();
								Painel::apagarimagem($fotoatual);
								$uparimagem = Painel::uparimagem($foto);
								$usuarios->atualizarusuario($nomeusuario,$nome,$sobrenome,$senha,$uparimagem);
								$_SESSION['nome_usuario'] = $nomeusuario;
								$_SESSION['foto_perfil'] = $uparimagem;
								Painel::mensagem('sucesso','A foto foi atualizada com sucesso!');
							}
						}else{
							$usuarios = new Usuarios();
							$foto = $fotoatual;
							$usuarios->atualizarusuario($nomeusuario,$nome,$sobrenome,$senha,$foto);
							Painel::mensagem('sucesso','As informações foram atualizadas com sucesso!');
						}
					}	
				?>
				<div>
					<p>Nome de usuário:</p>
					<input type="text" name="nome_usuario" value="<?php echo $_SESSION['nome_usuario'];?>">
				</div>
				<div>
					<p>Nome:</p>
					<input type="text" name="nome" value="<?php echo $_SESSION['nome'];?>">
				</div>
				<div>
					<p>Sobrenome:</p>
					<input type="text" name="sobrenome" value="<?php echo $_SESSION['sobrenome'];?>">
				</div>
				<div>
					<p>Senha:</p>
					<input type="password" name="senha" value="<?php echo $_SESSION['senha'];?>">
				</div>
				<div>
					<p>Foto de perfil:</p>
						<img src="<?php echo INCLUDE_PATH_PAINEL;?>imagens/uploads/<?php echo $_SESSION['foto_perfil'];?>">
				</div>
				<div>
					<p>Alterar foto de perfil:</p>
					<input type="hidden" name="fotoatual" value="<?php echo $_SESSION['foto_perfil'];?>">
					<input type="file" name="foto_perfil">
				</div>
				<div>
					<input type="submit" name="acao" value="Atualizar" required>
				</div>
			</form>
		</div>
	</div>
</section>