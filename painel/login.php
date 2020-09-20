<?php
	if(isset($_COOKIE['lembrar'])){
		$nome_usuario = $_COOKIE['nome_usuario'];
		$senha = $_COOKIE['senha'];
		$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios_site` WHERE nome_usuario = ? AND senha = ?");
		$sql->execute(array($nome_usuario,$senha));
			if($sql->rowCount() == 1){
				$informacao = $sql->fetch();
				$_SESSION['login'] = true;
				$_SESSION['nome_usuario'] = $nome_usuario;
				$_SESSION['nome'] = $informacao['nome'];
				$_SESSION['id'] = $informacao['id'];
				$_SESSION['sobrenome'] = $informacao['sobrenome'];
				$_SESSION['senha'] = $senha;
				$_SESSION['foto_perfil'] = $informacao['foto_perfil'];
				$_SESSION['tipo_usuario'] = $informacao['tipo_usuario'];
				Painel::redirecionamento();
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/fontawesome.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/brands.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/solid.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/stylelogin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<title>Bem-vindo | Acesse sua conta</title>
</head>
<body>
	<header>
		<div class="logo"></div>
		<nav>
			<ul>
				<li><a href="<?php echo INCLUDE_PATH;?>">Voltar à página inicial</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
	</header>
	<section>
		<div class="box-login">
			<div class="box-box-login">
				<h2>Acesse sua conta:</h2>
				<form method="post">
					<span></span>
					<?php
						if(isset($_POST['acao'])){
							$nome_usuario = $_POST['nome_usuario'];
							$senha = $_POST['senha'];
							$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios_site` WHERE nome_usuario = ? AND senha = ?");
							$sql->execute(array($nome_usuario,$senha));
							
							if($sql->rowCount() == 1){
								$informacao = $sql->fetch();
								$_SESSION['login'] = true;
								$_SESSION['nome_usuario'] = $nome_usuario;
								$_SESSION['nome'] = $informacao['nome'];
								$_SESSION['id'] = $informacao['id'];
								$_SESSION['sobrenome'] = $informacao['sobrenome'];
								$_SESSION['senha'] = $senha;
								$_SESSION['foto_perfil'] = $informacao['foto_perfil'];
								$_SESSION['tipo_usuario'] = $informacao['tipo_usuario'];
								if(isset($_POST['lembrar'])){
									setcookie('lembrar',true,time()+30,'/');
									setcookie('nome_usuario',$nome_usuario,time()+30,'/');
									setcookie('senha',$senha,time()+30,'/');
								}
								Painel::redirecionamento();
								die();
							}else{
								Painel::mensagem('erro','Usuário ou senha incorretos!');
							}
						}
					?>
				<div>
					<p>Nome de usuário:</p>
					<input type="text" name="nome_usuario">
				</div>
				<div>
					<p>Senha:</p>
					<input type="password" name="senha">
				</div>
				<div>
					<input type="submit" name="acao" value="Entrar">
				</div>
			</form>
			</div>
		</div>
	</section>
</body>
</html>