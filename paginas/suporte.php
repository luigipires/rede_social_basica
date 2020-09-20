<section>
	<div class="suporte">
		<h2>Suporte | Tire sua dúvida conosco</h2>
		<div class="ticket">
			<form method="post">
				<?php
					if(isset($_POST['suporte'])){
						$email = $_SESSION['email'];
						$pergunta = $_POST['pergunta'];
						$usuario_id = $_SESSION['id'];
						$token = md5(uniqid());

						if($pergunta == ''){
							\Painel::mensagem('erro','O campo está vazio!');
						}else{
							$envio = array('usuario_id'=>$usuario_id,'pergunta'=>$pergunta,'email'=>$email,'token'=>$token,'inserir'=>'suporte');
							\Painel::inseririnformacoes($envio);

							//$url = INCLUDE_PATH.'respostasuporte?token='.$token;
							//$emailcliente = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE usuario_id = ?");
							//$emailcliente->execute(array($usuario_id));
							//$emailcliente = $emailcliente->fetch();
							//$conteudoemail = 'Olá, $emailcliente, um usuário tem uma pergunta para você. Responda-o nesse link: <a href="'.$url.'">Ticket do usuário</a>';
							//$email = New Email('colocar servidor aqui','colocar e-mail aqui','senha','nomedoserver/pessoadoserver');
							//$email->adicionaremail($emailcliente['email']);
							//$email->conteudoemail(array('assunto'=>'Dúvida/suporte','corpo'=>$conteudoemail));
							//$email->enviaremail();

							\Painel::redirecionamento2(INCLUDE_PATH.'suporte?sucesso');
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['suporte']))
						\Painel::mensagem('sucesso','Mensagem enviada com sucesso!');
				?>
				<div>
					<p>Qual sua dúvida?</p>
					<textarea name="pergunta"></textarea>
				</div>
				<div>
					<input type="hidden" name="inserir" value="suporte">
					<input type="submit" name="suporte" value="Enviar">
				</div>
			</form>
		</div>
	</div>
</section>