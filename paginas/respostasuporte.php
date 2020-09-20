<?php
	$token = $_GET['token'];
	$emailusuario = \models\usuariosuporteModel::mostraremailusuario($token);
	$nomeusuario  = \models\usuariosuporteModel::pegarnomeusuario($emailusuario['usuario_id']);
?>
<section>
	<div class="respostasuporte">
		<h2>Visualizando pergunta de <i style="font-size: 25px;"><?php echo $nomeusuario;?></i></h2>
		<div style="text-align: center;border:0;padding: 0;margin-bottom: 40px;">
			<h4>Pergunta: <?php echo ucfirst($emailusuario['pergunta']); ?></h4>
		</div>
		<?php
			$puxarresposta = \MySql::conexaobd()->prepare("SELECT * FROM `comunicacao_suporte` WHERE token_usuario = ?");
			$puxarresposta->execute(array($token));
			$puxarresposta = $puxarresposta->fetchAll();

			foreach ($puxarresposta as $key => $value){
				if($value['admin'] == 1){
		?>
		<div>
			<p>Resposta:</p>
			<p style="padding: 0;"><b>Administrador</b>: <?php echo ucfirst($value['mensagem']);?>.</p>
		</div>
		<?php
				}else{
		?>
		<div>
			<p>Pergunta:</p>
			<p style="padding: 0;"><b><?php echo $nomeusuario;?></b>: <?php echo ucfirst($value['mensagem']);?></p>
		</div>
		<?php
				}
			}
		?>
		<?php
			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `comunicacao_suporte` WHERE token_usuario = ? ORDER BY id DESC");
			$sql->execute(array($token));

			if($sql->rowCount() == 0){
		?>
		<div style="text-align: center;border:0; margin-top: 40px;padding: 0;">
			<h3>Pergunta esperando resposta...</h3>
		</div>
		<?php
			}else{
				$sql = $sql->fetchAll();
				if($sql[0]['admin'] == -1){
		?>
			<div style="text-align: center;border:0; margin-top: 40px;padding: 0;">
				<h3>Pergunta esperando resposta...</h3>
			</div>
		<?php
				}else{
		?>
			<div style="border:0;">
				<p style="padding:20px 0 0 0;">A resposta te ajudou? se ainda tiver dúvidas, mande uma mensagem no campo abaixo!</p>
			</div>
			<form method="post">
				<?php
					if(isset($_POST['resposta'])){
						$mensagem = $_POST['mensagem'];

						if($mensagem == ''){
							\Painel::mensagem('erro','O campo está vazio!');
						}else{
							$envio = array('token_usuario'=>$token,'mensagem'=>$mensagem,'admin'=>'-1','status'=>'0','inserir'=>'comunicacao_suporte');
							\Painel::inseririnformacoes($envio);
							\Painel::mensagem('sucesso','Resposta enviado com sucesso!');
							sleep(1);
							\Painel::redirecionamento2(INCLUDE_PATH.'respostasuporte?token='.$token.'');
						}
					}
				?>
				<div>
					<textarea name="mensagem"></textarea>
				</div>
				<div>
					<input type="hidden" name="inserir" value="comunicacao_suporte">
					<input type="submit" name="resposta" value="Enviar">
				</div>
			</form>	
		<?php
				}
			}
		?>
	</div>
</section>