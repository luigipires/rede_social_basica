<?php
	class Email{
		private $mailer;

		public function __construct($host,$usuario,$senha,$nome_usuario){
			$this->mailer = new PHPMailer;

		    //Server settings
		    $this->mailer->isSMTP();
		    $this->mailer->Host = $host;
		   	$this->mailer->SMTPAuth = true;
		    $this->mailer->Username = $usuario;
		  	$this->mailer->Password = $senha;
		    $this->mailer->SMTPSecure = 'ssl';
		    $this->mailer->Port = 465;

		    //Recipients
		    $this->mailer->setFrom($usuario,$nome_usuario);

		    // Content
		    $this->mailer->isHTML(true);
		    $this->mailer->CharSet = 'UTF-8';
		}

		public function adicionaremail($email,$nome){
			$this->mailer->addAddress($email,$nome);
		}

		public function conteudoemail($conteudo){
			$this->mailer->Subject = $conteudo['assunto'];
			$this->mailer->Body = $conteudo['corpo'];
			$this->mailer->Altbody = strip_tags($conteudo['corpo']);
		}

		public function enviaremail(){
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}
	}
?>