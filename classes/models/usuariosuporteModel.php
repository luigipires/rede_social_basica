<?php
	namespace models;

	class usuariosuporteModel{
		public static function mostraremailusuario($token){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE token = ?");
			$sql->execute(array($token));
			return $sql->fetch();
		}

		public static function pegarusuarioid($id){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE usuario_id = ?");
			$sql->execute(array($id));
			return $sql->fetch();
		}

		public static function pegarnomeusuario($nome){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($nome));
			return $sql->fetch()['nome'];
		}
	}
?>