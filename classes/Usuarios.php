<?php
	class Usuarios{
		public function atualizarusuario($nome_usuario,$nome,$sobrenome,$senha,$foto_perfil){
			$sql = MySql::conexaobd()->prepare("UPDATE `usuarios_site` SET nome_usuario = ?, nome = ?, sobrenome = ?, senha = ?, foto_perfil = ? WHERE nome_usuario = ?");
			if($sql->execute(array($nome_usuario,$nome,$sobrenome,$senha,$foto_perfil,$_SESSION['nome_usuario']))){
				return true;
			}else{
				return false;
			}
		}

		public static function verificacaocadastros($usuario){
			$sql = MySql::conexaobd()->prepare("SELECT `id` FROM `usuarios_site` WHERE nome_usuario = ?");
			$sql->execute(array($usuario));
			if($sql->rowCount() == 0){
				return true;
			}else{
				return false;
			}
		}

		public static function verificacaoedicao($usuario,$id){
			$sql = MySql::conexaobd()->prepare("SELECT `id` FROM `usuarios_site` WHERE nome_usuario == ? AND id != ?");
			$sql->execute(array($usuario,$_SESSION['id']));
			$sql = $sql->fetch();
			if($sql->rowCount() == 0){
				return true;
			}else{
				return false;
			}
		}

		public static function cadastrarusuario($nome_usuario,$nome,$sobrenome,$senha,$foto_perfil){
			$sql = MySql::conexaobd()->prepare("INSERT INTO `usuarios_site` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($nome_usuario,$nome,$sobrenome,$senha,$foto_perfil));
		}
	}
?>