<?php
	namespace controller;

	use \views\mainView;

	class adminController{

		public function index(){
			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			mainView::render('admin.php',['controlleradmin'=>$this],'paginas/includes/headerlogin.php');
		}
		
	}
?>