<?php
	class Painel{

		public static function mensagem($resposta,$mensagem){
			if($resposta == 'sucesso'){
				echo '<div class="sucesso"><i class="fas fa-check-circle"></i>'.$mensagem.'</div>';
			}else if($resposta == 'erro'){
				echo '<div class="erro"><i class="fas fa-exclamation-triangle"></i>'.$mensagem.'</div>';
			}else if($resposta == 'alerta'){
				echo '<div class="alerta"><i class="fas fa-exclamation-circle"></i>'.$mensagem.'</div>';
			}
		}

		public static $tipousuario = [
			'0' => 'Administrador',
			'1' => 'Moderador',
			'2' => 'Cliente'
		];

		public static function formatacaomoeda($valor){
			$valor = str_replace('.','',$valor);
			$valor = str_replace(',','.',$valor);
			return $valor;
		}

		public static function conversaomoeda($valor){
			return number_format($valor, 2, ',', '.');
		}

		public static function carregarjavascript($arquivos,$paginas){
			$url = explode('/',@$_GET['url'])[0];
			if($paginas == $url){
				foreach ($arquivos as $key => $value){
					echo '<script src="'.INCLUDE_PATH_PAINEL.'javascript/'.$value.'"></script>';
				}
			}
		}

		public static function alertajavascript($mensagem){
			echo '<script>alert("'.$mensagem.'");</script>';
		}

		public static function redirecionamento(){
			header('Location: '.INCLUDE_PATH);
			die();
		}

		public static function redirecionamento2($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}

		public static function carregarpagina(){
			if(isset($_GET['url'])){
				$url = explode('/',$_GET['url']);
				if(file_exists('paginas/'.$url[0].'.php')){
					include('paginas/'.$url[0].'.php');
				}else{
					include('paginas/erro.php');
				}
			}else{
				include('paginas/home.php');
			}
		}

		public static function gerarurl($url){
			$url = mb_strtolower($url);
			$url = preg_replace('/(á|à|ã)/', 'a', $url);
			$url = preg_replace('/(ê|é)/', 'e', $url);
			$url = preg_replace('/(í)/', 'i', $url);
			$url = preg_replace('/(ó|ô|õ|ö)/', 'o', $url);
			$url = preg_replace('/(ú)/', 'u', $url);
			$url = preg_replace('/(ç)/', 'c', $url);
			$url = preg_replace('/( )/', '-', $url);
			$url = preg_replace('/(_|\/|!|\?|#)/', '', $url);
			$url = preg_replace('/([-]{1,})/', '-', $url);
			$url = preg_replace('/(,)/', '-', $url);
			$url = strtolower($url);
			return $url;
		}

		public static function validacaoimagem($imagem){
			if($imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/png'){
				$tamanhoimagem = intval($imagem['size']/2048);
					if($tamanhoimagem < 700)
						return true;
					else
						return false;
			}else{
				return false;
			}
		}

		public static function uparimagemusuario($arquivo){
			$formatoarquivo = explode('.',$arquivo['name']);
			$arquivonome = uniqid().'.'.$formatoarquivo[count($formatoarquivo) - 1];
			if(move_uploaded_file($arquivo['tmp_name'],IMAGEMSITE.'/usuarios/'.$arquivonome))
				return $arquivonome;
			else
				return false;
		}

		public static function uparimagemfeed($arquivo){
			$formatoarquivo = explode('.',$arquivo['name']);
			$arquivonome = uniqid().'.'.$formatoarquivo[count($formatoarquivo) - 1];
			if(move_uploaded_file($arquivo['tmp_name'],IMAGEMSITE.'/feed/'.$arquivonome))
				return $arquivonome;
			else
				return false;
		}

		public static function apagarimagemusuario($imagem){
			@unlink('imagens/usuarios/'.$imagem);
		}

		public static function apagarimagemfeed($imagem){
			@unlink('imagens/feed/'.$imagem);
		}

		public static function inseririnformacoes($info){
			$certo = true;
			$tabela = $info['inserir'];
			$query = "INSERT INTO `$tabela` VALUES (null";
			foreach ($info as $key => $value) {
				$nome = $key;
				if($nome == 'acao' || $nome == 'inserir')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = MySql::conexaobd()->prepare($query);
				$sql->execute($parametros);
			}
			return $certo;
		}

		public static function inseririnformacoescomordenacao($info){
			$certo = true;
			$tabela = $info['inserir'];
			$query = "INSERT INTO `$tabela` VALUES (null";
			foreach ($info as $key => $value) {
				$nome = $key;
				if($nome == 'acao' || $nome == 'inserir')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = MySql::conexaobd()->prepare($query);
				$sql->execute($parametros);
				$id = MySql::conexaobd()->lastInsertId();
				$sql = MySql::conexaobd()->prepare("UPDATE `$tabela` SET ordenacao = ? WHERE id = $id");
				$sql->execute(array($id));
			}
			return $certo;
		}

		public static function editarinformacoes($info,$update = false){
			$certo = true;
			$falso = false;
			$tabela = $info['inserir'];
			$query = "UPDATE `$tabela` SET ";
			
			foreach ($info as $key => $value){
				$nome = $key;
				if($nome == 'acao' || $nome == 'inserir')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				if($falso == false){
					$falso = true;
					$query.="$nome=?";
				}else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($update == false){
					$parametros[] = $info['id'];
					$sql = MySql::conexaobd()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::conexaobd()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
		}

		public static function buscartodasinformacoes($tabela,$query = '',$valor = ''){
			if($query != false){
				$sql = MySql::conexaobd()->prepare("SELECT * FROM `$tabela` WHERE $query");
				$sql->execute($valor);
			}else{
				$sql = MySql::conexaobd()->prepare("SELECT * FROM `$tabela`");
				$sql->execute();
			}
			return $sql->fetch();
		}
		
		public static function buscarinformacoes($tabela,$comecar = null,$terminar = null){
			if($comecar == null && $terminar == null){
				$sql = MySql::conexaobd()->prepare("SELECT * FROM `$tabela`");
			}else{
				$sql = MySql::conexaobd()->prepare("SELECT * FROM `$tabela` LIMIT $comecar,$terminar");
			}
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function ordenacao($tabela,$ordem,$id){
			if($ordem == 'cima'){
				$itematual = Painel::buscartodasinformacoes($tabela,'id = ?',array($id));
				$ordenacao = $itematual['ordenacao'];
				$antes = MySql::conexaobd()->prepare("SELECT * FROM `$tabela` WHERE ordenacao < $ordenacao ORDER BY ordenacao DESC LIMIT 1");
				$antes->execute();
				if($antes->rowCount() == 0)
					return;
				$antes = $antes->fetch();
				Painel::editarinformacoes(array('inserir'=>$tabela,'id'=>$antes['id'],'ordenacao'=>$itematual['ordenacao']));
				Painel::editarinformacoes(array('inserir'=>$tabela,'id'=>$itematual['id'],'ordenacao'=>$antes['ordenacao']));
			}else if($ordem == 'baixo'){
				$itematual = Painel::buscartodasinformacoes($tabela,'id = ?',array($id));
				$ordenacao = $itematual['ordenacao'];
				$depois = MySql::conexaobd()->prepare("SELECT * FROM `$tabela` WHERE ordenacao > $ordenacao ORDER BY ordenacao ASC LIMIT 1");
				$depois->execute();
				if($depois->rowCount() == 0)
					return;
				$depois = $depois->fetch();
				Painel::editarinformacoes(array('inserir'=>$tabela,'id'=>$depois['id'],'ordenacao'=>$itematual['ordenacao']));
				Painel::editarinformacoes(array('inserir'=>$tabela,'id'=>$itematual['id'],'ordenacao'=>$depois['ordenacao']));
			}
		}

		public static function deletarinformacoes($tabela,$id = false){
			if($id == false){
				$sql = MySql::conexaobd()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = MySql::conexaobd()->prepare("DELETE FROM `$tabela` WHERE id = $id");
			}
			$sql->execute();
		}

		public static function deletartodasinformacoes($tabela,$query = '',$valor = ''){
			if($query != false){
				$sql = MySql::conexaobd()->prepare("DELETE FROM `$tabela` WHERE $query");
				$sql->execute($valor);
			}else{
				$sql = MySql::conexaobd()->prepare("DELETE FROM `$tabela`");
				$sql->execute();
			}
		}

		public static function mostrartodasinformacoes($tabela){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `$tabela`");
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function recuperarcampopreenchido($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}

	}
?>