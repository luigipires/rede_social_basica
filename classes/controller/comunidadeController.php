<?php
	namespace controller;

	use \views\mainView;

	class comunidadeController{
		public function index(){

			if(!isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH);
			}

			if(isset($_GET['add-friend'])){
				$idfriend = (int)$_GET['add-friend'];
				if($this->solicitacaoamizadependente($idfriend) == false){
					$this->solicitacaoamizade($idfriend);
					\Painel::alertajavascript('Solicitação de amizade enviada');
				}
				\Painel::redirecionamento2(INCLUDE_PATH.'comunidade');
			}

			mainView::render('comunidade.php',['controllercomunidade'=>$this],'paginas/includes/headerlogin.php');
		}

		public function solicitacaoamizade($idfriend){
			$sql = \MySql::conexaobd()->prepare("INSERT INTO `amigos` VALUES (null,?,?,0)");
			$sql->execute(array($_SESSION['id'],$idfriend));
		}

		public function solicitacaoamizadependente($idfriend){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `amigos` WHERE (id_from = ? AND id_to = ? AND status = 0) OR (id_from = ? AND id_to = ? AND status = 0)");
			$sql->execute(array($_SESSION['id'],$idfriend,$idfriend,$_SESSION['id']));

			if($sql->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}

		public function amizadeaceita($idfriend){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `amigos` WHERE (id_from = ? AND id_to = ? AND status = 1) OR (id_from = ? AND id_to = ? AND status = 1)");
			$sql->execute(array($_SESSION['id'],$idfriend,$idfriend,$_SESSION['id']));

			if($sql->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}
	}
?>