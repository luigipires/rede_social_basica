<?php
	$parametros = \views\mainView::$parametro;
?>
<section>
	<div class="perfil-single">
		<div class="info-perfil-single">
			<div class="foto-perfil-single">
				<img src="<?php echo INCLUDE_PATH; ?>imagens/usuarios/<?php echo $parametros['fotoperfil']; ?>">
			</div>
			<div class="user-perfil-single">
				<h2><?php echo $parametros['nome']; ?></h2>
			</div>
		</div>
		
		<div class="postagens-perfil">
			<h2>Mostrando as postagens de <b><?php echo $parametros['nome']; ?></b></h2>
			<?php
				$postagens = \MySql::conexaobd()->prepare("SELECT * FROM `feed` WHERE usuario_id = ?");
				$postagens->execute(array($parametros['id']));
				$postagens = $postagens->fetchAll();

				foreach ($postagens as $key => $value){
			?>
			<div class="all-posts">
				<p><?php echo $value['titulo']; ?></p>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</section>