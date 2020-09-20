<?php
	namespace controller;

	use \views\mainView;

	class respostasuporteController{
		public function pegartoken(){
			$token = $_GET['token'];
			$verificacao = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE token = ?");
			$verificacao->execute(array($token));

			if($verificacao->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}

		public function index(){

			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}
			
			mainView::render('respostasuporte.php',['controllerrespostasuporte'=>$this],'paginas/includes/headerlogin.php');
		}
	}
?>