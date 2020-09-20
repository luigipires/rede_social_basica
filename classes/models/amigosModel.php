<?php
	namespace models;

	class amigosModel{
		public static function pegaridamigo($id){
			$informacao = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$informacao->execute(array($id));
			return $informacao->fetch();
		}
		public static function listaramigos(){
			$informacao = \MySql::conexaobd()->prepare("SELECT * FROM `amigos` WHERE (id_from = ? AND status = 1) OR (id_to = ? AND status = 1)");
			$informacao->execute(array($_SESSION['id'],$_SESSION['id']));
			$informacao = $informacao->fetchAll();
			$arr = [];
			$id = $_SESSION['id'];

			foreach ($informacao as $amigos){
				if($amigos['id_from'] == $id){
					$arr[] = $amigos['id_to'];
				}else{
					$arr[] = $amigos['id_from'];
				}
			}

			return $arr;
		}
	}
?>