<?php
	namespace models;

	class perfilModel{
		public static function pegarnomeusuario($nome){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($nome));
			return $sql->fetch();
		}

		public static function montarperfil($nomeperfil){
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($nomeperfil));
			return $sql->fetchAll();
		}
	}
?>