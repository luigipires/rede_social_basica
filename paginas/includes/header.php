<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>slimther.ico" type="image/x-icon" />
	<meta charset="utf-8">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/stylerede.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/fontawesome.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/brands.css">
	<link  rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/solid.css">
	<title>Rede social</title>
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
		<div class="login">
			<form method="post">
				<input type="text" name="email">
				<input type="password" name="senha">
				<input type="submit" name="login" value="Entrar">
			</form>
		</div>
		<div class="clear"></div>
	</header>