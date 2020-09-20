<?php
	namespace controller;

	use \views\mainView;

	class solicitacoesController{
		public function index(){

			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			if(isset($_GET['aceitar'])){
				$idsolicitacaoenviado = (int)$_GET['aceitar'];
				$sql = \MySql::conexaobd()->prepare("UPDATE `amigos` SET status = 1 WHERE id_from = ? AND id_to = ?");
				$sql->execute(array($idsolicitacaoenviado,$_SESSION['id']));
			}else if(isset($_GET['excluir'])){
				$idsolicitacaoenviado = (int)$_GET['excluir'];
				$sql = \MySql::conexaobd()->prepare("DELETE FROM `amigos` WHERE id_from = ? AND id_to = ?");
				$sql->execute(array($idsolicitacaoenviado,$_SESSION['id']));
			}

			mainView::render('solicitacao.php',['controllersolicitacao'=>$this],'paginas/includes/headerlogin.php');
		}

		public static function listarsolicitacoes(){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `amigos` WHERE id_to = ? AND status = 0");
			$sql->execute(array($_SESSION['id']));
			return $sql->fetchAll();
		}
	}
?>