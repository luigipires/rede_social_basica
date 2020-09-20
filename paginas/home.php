<section>
	<div class="cadastro">
		<h2>Cadastre-se e se encontre com outras pessoas</h2>
		<form method="post" enctype="multipart/form-data">
			<div>
				<p>Coloque seu nome:</p>
				<input type="text" name="nome" value="<?php \Painel::recuperarcampopreenchido('nome');?>">
			</div>
			<div>
				<p>Coloque seu e-mail:</p>
				<input type="text" name="email" value="<?php \Painel::recuperarcampopreenchido('email');?>">
			</div>
			<div>
				<p>Coloque uma senha:</p>
				<input type="password" name="senha" value="<?php \Painel::recuperarcampopreenchido('senha');?>">
			</div>
			<div>
				<p>Coloque sua foto:</p>
				<input type="file" name="fotoperfil">
			</div>
			<div>
				<input type="hidden" name="inserir" value="usuarios">
				<input type="submit" name="acao" value="Cadastrar">
			</div>
		</form>
	</div>
</section>