<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>slimther.ico" type="image/x-icon" />
	<meta charset="utf-8">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/stylelogin.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/fontawesome.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/brands.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/solid.css">
	<title>Slimther | <?php echo $_SESSION['nome'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
</head>
<body>
	<base base="<?php echo INCLUDE_PATH; ?>"></base>
	<header>
		<div class="logo-header">
			<a href="<?php echo INCLUDE_PATH; ?>">
				<h3><i class="fab fa-stumbleupon"></i></h3>
				<p>Slimther</p>
				<div class="clear"></div>
			</a>
		</div>
		<div class="buttons">
			<a href="<?php echo INCLUDE_PATH; ?>user?logout">
				<h3><i class="fas fa-sign-out-alt"></i></h3>
				<p>Sair</p>
			</a>
			<div class="clear"></div>
		</div>
		<div class="buttons">
			<a href="<?php echo INCLUDE_PATH; ?>comunidade">
				<h3><i class="fas fa-users"></i></h3>
				<p>Comunidade</p>
			</a>
			<div class="clear"></div>
		</div>
		<div class="buttons">
			<?php
				$solicitacao = count(\controller\solicitacoesController::listarsolicitacoes());
			?>
			<a href="<?php echo INCLUDE_PATH; ?>solicitacao">
				<h3><i class="fas fa-user-plus"></i></h3>
				<p>Solicitações (<?php echo $solicitacao?>)</p>
			</a>
			<div class="clear"></div>
		</div>
		<div class="buttons">
			<a href="<?php echo INCLUDE_PATH; ?>suporte">
				<h3><i class="fas fa-comments"></i></h3>
				<p>Suporte</p>
			</a>
			<div class="clear"></div>
		</div>
		<nav class="mobile">
			<h3><i class="fas fa-bars"></i></h3>
			<ul>
				<li>
					<a href="<?php echo INCLUDE_PATH; ?>solicitacao">
						<h3><i class="fas fa-user-plus"></i></h3>
						<p>Solicitações (<?php echo $solicitacao?>)</p>
					</a>
				</li>
				<li>
					<a href="<?php echo INCLUDE_PATH; ?>comunidade">
						<h3><i class="fas fa-users"></i></h3>
						<p>Comunidade</p>
					</a>
				</li>
				<li>
					<a href="<?php echo INCLUDE_PATH; ?>suporte">
						<h3><i class="fas fa-comments"></i></h3>
						<p>Suporte</p>
					</a>
				</li>
				<li>
					<a href="<?php echo INCLUDE_PATH; ?>user?logout">
						<h3><i class="fas fa-sign-out-alt"></i></h3>
						<p>Sair</p>
					</a>
				</li>
			</ul>
		</nav>
		<div class="clear"></div>
	</header>