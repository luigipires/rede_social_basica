<?php
	session_start();

	ob_start();

	date_default_timezone_set('America/Sao_Paulo');

	define('INCLUDE_PATH','http://localhost/PHP_aulas/redesocial/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
	define('IMAGENS',__DIR__.'/painel/imagens/');
	define('IMAGEMSITE',__DIR__.'/imagens/');
	

	define('HOST','localhost');
	define('DATABASE','redesocial');
	define('USER','root');
	define('PASSWORD','');

	$autoload = function($classe){
		if($classe == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$classe.'.php');
	};

	spl_autoload_register($autoload);

	function destaque($destaque){
		$url = explode('/',@$_GET['url'])[0];
		if($url == $destaque){
			echo 'class="destaque"';
		}
	}

	function verificacaopermissao($permissao){
		if($_SESSION['tipo_usuario'] <= $permissao){
			return;
		}else{
			echo 'style="display:none"';
		}
	}

	function permissao($permissao){
		if($_SESSION['tipo_usuario'] <= $permissao){
			return;
		}else{
			include('painel/paginas/permissaonegada.php');
			die();
		}
	}
?>