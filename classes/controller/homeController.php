<?php
	namespace controller;

	use \views\mainView;

	class homeController{
		
		public function index(){
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];
				$fotoperfil = $_FILES['fotoperfil'];

				if($nome === ''){
					\Painel::alertajavascript('Você precisa colocar seu nome!');
				}else if($email == '' || filter_var($email,FILTER_VALIDATE_EMAIL) == false){
					\Painel::alertajavascript('Você precisa colocar um e-mail válido!');
				}else if($senha == ''){
					\Painel::alertajavascript('Você precisa colocar sua senha!');
				}else if($fotoperfil['name'] == ''){
					\Painel::alertajavascript('Você precisa upar uma foto!');
				}else{
					if(\Painel::validacaoimagem($fotoperfil) == false){
						\Painel::alertajavascript('Foto inválida! Verifique o tamanho e o formato da imagem.');
					}else{
						$sql = \MySql::conexaobd()->prepare("SELECT email FROM `usuarios` WHERE email = ?");
						$sql->execute(array($email));

						if($sql->rowCount() == 0){
							$fotoupada = \Painel::uparimagemusuario($fotoperfil);
							$envio = array('nome'=>$nome,'email'=>$email,'senha'=>$senha,'fotoperfil'=>$fotoupada,'inserir'=>'usuarios');
							\Painel::inseririnformacoes($envio);
							\Painel::alertajavascript('Usuário cadastrado com sucesso!');
						}else{
							\Painel::alertajavascript('Esse usuário já existe!');
						}
					}
				}
			}

			if(isset($_POST['login'])){
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ? AND senha = ?");
				$sql->execute(array($email,$senha));

				if($sql->rowCount() == 1){
					$sql = $sql->fetch();
					$_SESSION['login'] = $email;
					$_SESSION['id'] = $sql['id'];
					$_SESSION['email'] = $sql['email'];
					$_SESSION['nome'] = $sql['nome'];
					$_SESSION['fotoperfil'] = $sql['fotoperfil'];
					sleep(1);
					\Painel::redirecionamento2(INCLUDE_PATH.'user');
				}else{
					\Painel::alertajavascript('E-mail ou senha incorretos!');
				}
			}

			if(isset($_SESSION['login'])){
				\Painel::redirecionamento2(INCLUDE_PATH.'user');
			}
			
			mainView::render('home.php');
		}
	}
?>