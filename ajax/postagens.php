<?php
	include('../constants.php');

	$data['sucesso'] = true;
	$data['mensagem'] = "";

	if(!isset($_SESSION['login'])){
		die('Você não está logado!');
	}
							
		if(isset($_POST['feed'])){
			$titulo = $_POST['titulo'];
			$conteudo = $_POST['conteudo'];

			$foto = [];
			$fotoconteudo = '';

			sleep(2);

			if($titulo == ''){
				$data['sucesso'] = false;
				$data['mensagem'] = 'Você precisa colocar um título na postagem!';
			}else if($conteudo == ''){
				$data['sucesso'] = false;
				$data['mensagem'] = 'Você precisa colocar o conteúdo na postagem!';
			}else if(isset($_FILES['fotoconteudo']['name'][0])){
				$fotoconteudo = count($_FILES['fotoconteudo']['name']);
				for($i = 0; $i < $fotoconteudo; $i++){
					$fotoupada = ['type'=>$_FILES['fotoconteudo']['type'][$i],'size'=>$_FILES['fotoconteudo']['size'][$i]];
					if(\Painel::validacaoimagem($fotoupada) == false){
						$data['sucesso'] = false;
						$data['mensagem'] = 'O formato de uma das imagens não são válidas!';						
						break;
					}else{
						for($i = 0; $i < $fotoconteudo; $i++){
							$fotoupada = ['tmp_name'=>$_FILES['fotoconteudo']['tmp_name'][$i],'name'=>$_FILES['fotoconteudo']['name'][$i]];
							$foto[] = Painel::uparimagemfeed($fotoupada);
						}
						$sql = \MySql::conexaobd()->prepare("INSERT INTO `feed` VALUES (null,?,?,?)");
						$sql->execute(array($_SESSION['id'],$titulo,$conteudo));
						$idfeed = \MySql::conexaobd()->lastInsertId();

						foreach ($foto as $key => $value){
							\MySql::conexaobd()->exec("INSERT INTO `imagempost` VALUES (null,$idfeed,'$value')");
						}
						$data['sucesso'] = true;
						$data['mensagem'] = 'Dados enviados com sucesso!';
					}
				}
			}else{
				$sql = \MySql::conexaobd()->prepare("INSERT INTO `feed` VALUES (null,?,?,?)");
				$sql->execute(array($_SESSION['id'],$titulo,$conteudo));
				$data['sucesso'] = true;
				$data['mensagem'] = 'Postagem realizada com sucesso!';
			}
		}

	die(json_encode($data));
?>