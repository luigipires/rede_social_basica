<?php
	namespace controller;

	use \views\mainView;

	class userController{
		public function index(){

			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			mainView::render('user.php',[],'paginas/includes/headerlogin.php');
		}
	}
?>