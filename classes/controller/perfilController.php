<?php
	namespace controller;

	use \views\mainView;

	class perfilController{
		public function index($parametro){

			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE nome = '$parametro[2]'");
			$sql->execute();
			$sql = $sql->fetch();

			mainView::colocaparametro(['nome'=>$sql['nome'],'fotoperfil'=>$sql['fotoperfil'],'id'=>$sql['id'],'informacoes'=>\models\perfilModel::montarperfil($sql['id'])]);

			mainView::render('perfil.php',[],'paginas/includes/headerlogin.php');
		}
	}
?>