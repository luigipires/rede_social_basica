<?php
	if(isset($_GET['editar'])){
		$id = (int)$_GET['editar'];
		$propaganda = Painel::buscartodasinformacoes('propaganda','id = ?',array($id));
	}else{
		Painel::mensagem('erro','Você precisa pegar o ID da foto!');
		die();
	}
?>
<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-images"></i></h3>
			<h2>Editar fotos</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<?php
					if(isset($_POST['acao'])){
						$foto = $_FILES['fotos'];
						$fotoatual = $_POST['fotoatual'];

						if($foto['name'] != ''){
							if(Painel::validacaoimagem($foto) == false){
								Painel::mensagem('erro','O formato da imagem não é válido.');
							}else{
								Painel::apagarimagempropaganda($fotoatual);
								$uparimagem = Painel::uparimagempropaganda($foto);
								$envio = array('fotos'=>$uparimagem,'id'=>$id,'inserir'=>'propaganda');
								Painel::editarinformacoes($envio);
								$propaganda = Painel::buscartodasinformacoes('propaganda','id = ?',array($id));
								Painel::mensagem('sucesso','A foto atualizada com sucesso!');
							}
						}else{
							$foto = $fotoatual;
							$envio = array('fotos'=>$foto,'id'=>$id,'inserir'=>'propaganda');
							Painel::editarinformacoes($envio);
							$propaganda = Painel::buscartodasinformacoes('propaganda','id = ?',array($id));
							Painel::mensagem('sucesso','A foto atualizada com sucesso!');
						}
					}	
				?>
				<div>
					<div>
						<p>Foto da propaganda:</p>
						<img src="<?php echo INCLUDE_PATH_PAINEL;?>imagens/propagandas/<?php echo $propaganda['fotos'];?>">
					</div>
					<div>
						<p>Alterar foto:</p>
						<input type="hidden" name="fotoatual" value="<?php echo $propaganda['fotos'];?>">
						<input type="file" name="fotos">
					</div>
				</div>
				<div>
					<input type="hidden" name="inserir" value="propaganda">
					<input type="submit" name="acao" value="Atualizar">
				</div>
			</form>
		</div>
	</div>
</section>