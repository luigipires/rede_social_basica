<?php
	$duvidas = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` ORDER BY id DESC");
	$duvidas->execute();
	$duvidas = $duvidas->fetchAll();
?>
<section>
	<div class="admin">
		<h2>Novas perguntas de usuários:</h2>
		<?php
			foreach ($duvidas as $key => $value){
				$infousuario = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE usuario_id = ?");
				$infousuario->execute(array($value['usuario_id']));
				$infousuario = $infousuario->fetch();

				$nomeusuario = \models\usuariosuporteModel::pegarnomeusuario($infousuario['usuario_id']);

				$verificaratividadeadm = \MySql::conexaobd()->prepare("SELECT * FROM `comunicacao_suporte` WHERE token_usuario = ?");
				$verificaratividadeadm->execute(array($value['token']));

				if($verificaratividadeadm->rowCount() >= 1)
					continue;
		?>
		<div style="text-align: center;">
			<h2><?php echo ucfirst($nomeusuario); ?> - Pergunta: <?php echo ucfirst($value['pergunta']); ?></h2>
		</div>
		<form method="post">
			<?php
				if(isset($_POST['resposta_user1'])){
					$mensagem = $_POST['mensagem'];
					$token = $_POST['token'];
					$email = $_POST['email'];

					if($mensagem == ''){
						\Painel::mensagem('erro','O campo está vazio!');
					}else{
						$envio = array('token_usuario'=>$token,'mensagem'=>$mensagem,'admin'=>'1','status'=>'1','inserir'=>'comunicacao_suporte');
						\Painel::inseririnformacoes($envio);

						$idresposta = \MySql::conexaobd()->lastInsertId();
						$status = \MySql::conexaobd()->prepare("UPDATE `comunicacao_suporte` SET status = 1 WHERE id = ?");
						$status->execute(array($idresposta));

						//$url = INCLUDE_PATH.'admin?token='.$token;
						//$emailcliente = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE email = ?");
						//$emailcliente->execute(array($email));
						//$emailcliente = $emailcliente->fetch();
						//$conteudoemail = 'Olá, $emailcliente[''], respondemos sua pergunta. Acesse-o nesse link: <a href="'.$url.'">Ticket do usuário</a>';
						//$email = New Email('colocar servidor aqui','colocar e-mail aqui','senha','nomedoserver/pessoadoserver');
						//$email->adicionaremail($emailcliente['email']);
						//$email->conteudoemail(array('assunto'=>'Sua pergunta foi respondida','corpo'=>$conteudoemail));
						//$email->enviaremail();

						\Painel::alertajavascript('Resposta enviada com sucesso!');
						\Painel::redirecionamento2(INCLUDE_PATH.'admin');
					}
				}
			?>
			<div>
				<textarea name="mensagem"></textarea>
			</div>
			<div>
				<input type="hidden" name="email" value="<?php echo $value['email'];?>">
				<input type="hidden" name="token" value="<?php echo $value['token'];?>">
				<input type="hidden" name="inserir" value="comunicacao_suporte">
				<input type="submit" name="resposta_user1" value="Enviar">
			</div>
		</form>
		<?php
			}
		?>
		<?php
			$verificarretornoatividadeadm = \MySql::conexaobd()->prepare("SELECT * FROM `comunicacao_suporte` WHERE admin = -1 AND status = 0 ORDER BY id DESC");
			$verificarretornoatividadeadm->execute();

			foreach ($verificarretornoatividadeadm as $key2 => $value2){
				$verificaratividaderespostaadm = \MySql::conexaobd()->prepare("SELECT * FROM `comunicacao_suporte` WHERE token_usuario = ?");
				$verificaratividaderespostaadm->execute(array($value2['token_usuario']));
		?>
		<div style="text-align: center;">
			<h2><?php echo ucfirst($nomeusuario); ?> - Pergunta: <?php echo ucfirst($value2['mensagem']); ?></h2>
		</div>
		<div>
			<a target="_blank" href="<?php echo INCLUDE_PATH;?>respostasuporte?token=<?php echo $value2['token_usuario'];?>">Ver restante da conversa</a>
		</div>
		<form method="post">
			<?php
				if(isset($_POST['resposta_user'])){
					$mensagem = $_POST['mensagem'];
					$tokenresposta = $_POST['tokenresposta'];
					$emailresposta = $_POST['emailresposta'];

					if($mensagem == ''){
						\Painel::mensagem('erro','O campo está vazio!');
					}else{
						$envio = array('token_usuario'=>$tokenresposta,'mensagem'=>$mensagem,'admin'=>'1','status'=>'1','inserir'=>'comunicacao_suporte');
						\Painel::inseririnformacoes($envio);

						$status2 = \MySql::conexaobd()->prepare("UPDATE `comunicacao_suporte` SET status = 1 WHERE id = ?");
						$status2->execute(array($_POST['id']));

						//$url = INCLUDE_PATH.'admin?token='.$tokenresposta;
						//$emailcliente = \MySql::conexaobd()->prepare("SELECT * FROM `suporte` WHERE email = ?");
						//$emailcliente->execute(array($emailresposta));
						//$emailcliente = $emailcliente->fetch();
						//$conteudoemail = 'Olá, $emailcliente[''], respondemos sua pergunta. Acesse-o nesse link: <a href="'.$url.'">Ticket do usuário</a>';
						//$email = New Email('colocar servidor aqui','colocar e-mail aqui','senha','nomedoserver/pessoadoserver');
						//$email->adicionaremail($emailcliente['email']);
						//$email->conteudoemail(array('assunto'=>'Sua pergunta foi respondida','corpo'=>$conteudoemail));
						//$email->enviaremail();

						\Painel::alertajavascript('Resposta enviada com sucesso!');
						\Painel::redirecionamento2(INCLUDE_PATH.'admin');
					}
				}
			?>
			<div>
				<textarea name="mensagem"></textarea>
			</div>
			<div>
				<input type="hidden" name="id" value="<?php echo $value2['id'];?>">
				<input type="hidden" name="emailresposta" value="<?php echo $value2['email'];?>">
				<input type="hidden" name="tokenresposta" value="<?php echo $value2['token_usuario'];?>">
				<input type="hidden" name="inserir" value="comunicacao_suporte">
				<input type="submit" name="resposta_user" value="Enviar">
			</div>
		</form>
		<?php
			}
		?>
	</div>
</section>