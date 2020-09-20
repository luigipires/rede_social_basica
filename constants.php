<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require('vendor/autoload.php');

	$autoload = function($classe){
		if($classe == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$classe.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://localhost/PHP_aulas/redesocial/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
	define('IMAGENS',__DIR__.'/painel/imagens/');
	define('IMAGEMSITE',__DIR__.'/imagens/');

	define('HOST','localhost');
	define('DATABASE','redesocial');
	define('USER','root');
	define('PASSWORD','');
?>