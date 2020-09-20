<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-images"></i></h3>
			<h2>Adicionar fotos</h2>
		</div>
		<div class="atualizar-config">
			<form method="post" enctype="multipart/form-data">
				<?php
					if(isset($_POST['acao'])){
						$foto = $_FILES['fotos'];

						if($foto['name'] == ''){
							Painel::mensagem('erro','Você precisa carregar uma foto.');
						}else{
							if(Painel::validacaoimagem($foto) == false){
								Painel::mensagem('erro','O formato da imagem não é válido.');
							}else{
								$uparimagem = Painel::uparimagempropaganda($foto);
								$envio = array('fotos'=>$uparimagem,'inserir'=>'propaganda');
								Painel::inseririnformacoes($envio);
								Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'adicionar-propagandas?sucesso');
							}
						}
					}
					if(isset($_GET['sucesso']) && !isset($_POST['acao']))
						Painel::mensagem('sucesso','A foto inserida com sucesso!');	
				?>
				<div>
					<p>Foto da propaganda:</p>
					<input type="file" name="fotos">
				</div>
				<div>
					<input type="hidden" name="inserir" value="propaganda">
					<input type="submit" name="acao" value="Adicionar">
				</div>
			</form>
		</div>
	</div>
</section>