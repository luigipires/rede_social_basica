<section>
	<div class="comunidade">
		<h2>Comunidade | faça amizades</h2>
		<?php
			$pessoas = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id != ?");
			$pessoas->execute(array($_SESSION['id']));
			$pessoas = $pessoas->fetchAll();

			foreach ($pessoas as $key => $value){
		?>
		<div class="pessoas">
			<div class="pessoa-single">
				<div class="foto-pessoa">
					<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $value['fotoperfil'];?>">
				</div>
				<div class="lattes-pessoa">
					<h3><i class="fas fa-user"></i></h3>
					<p><?php echo $value['nome'];?></p>
				</div>
				<?php
					if($arr['controllercomunidade']->amizadeaceita($value['id']) == true){
						echo '<div><span style="background-color:#52C87B;border:1px solid #307548;margin:5px 0 8px 0;"><h3 style="color:white;display:inline-block; padding-right:10px;"><i class="fas fa-check"></i></h3>Amigo</span></div>';
					}else if($arr['controllercomunidade']->solicitacaoamizadependente($value['id']) == false){
				?>
				<div>
					<a href="<?php echo INCLUDE_PATH; ?>comunidade?add-friend=<?php echo $value['id'];?>">Adicionar amigo</a>
				</div>
				<?php
					}else{
				?>
				<div>
					<span style="opacity: 0.4;background-color: #666666;border:1px solid black">Solicitação enviada</span>
				</div>
				<?php
					}
				?>
			</div>
		</div>
		<?php
			}
		?>
		<div class="clear"></div>
	</div>
</section>