<section>
	<div class="solicitacoes">
		<h2>Suas solicitações</h2>
		<?php
			$solicitacoes = \controller\solicitacoesController::listarsolicitacoes();
			foreach ($solicitacoes as $key => $value){
				$amigo = \models\amigosModel::pegaridamigo($value['id_from']);
		?>
		<div class="friend">
			<div class="friend-single">
				<div class="foto-friend">
					<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $amigo['fotoperfil'];?>">
				</div>
				<div class="lattes-friend">
					<h3><i class="fas fa-user"></i></h3>
					<p><?php echo $amigo['nome'];?></p>
				</div>
				<div class="buttons-friend">
					<a href="<?php echo INCLUDE_PATH; ?>solicitacao?aceitar=<?php echo $value['id_from'];?>">Aceitar solicitação</a>
					<a href="<?php echo INCLUDE_PATH; ?>solicitacao?excluir=<?php echo $value['id_from'];?>">Excluir solicitação</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
			}
		?>
	</div>
</section>