<?php
	if(isset($_GET['excluir'])){
		$excluir = $_GET['excluir'];
		Painel::deletarinformacoes('propaganda',$excluir);
		Painel::redirecionamento2(INCLUDE_PATH_PAINEL.'adicionar-propagandas');
	}

	$primeirapagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$cadapagina = 4;

	$propaganda = Painel::buscarinformacoes('propaganda',($primeirapagina - 1)*$cadapagina,$cadapagina);
?>
<section class="sessao">
	<div class="padraopagina">
		<div>
			<h3><i class="fas fa-images"></i></h3>
			<h2>Listagem de fotos</h2>
		</div>
		<div class="atualizar-config">
			<table>
				<tr class="tabela01">
					<td>Fotos da propaganda</td>
					<td></td>
					<td></td>
				</tr>
				<?php
					foreach ($propaganda as $key => $value){
				?>
				<tr class="tabela02">
					<td><img src="<?php echo INCLUDE_PATH_PAINEL;?>imagens/propagandas/<?php echo $value['fotos'];?>"></td>
					<td><a class="botao" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-propagandas?editar=<?php echo $value['id'];?>"><i class="fas fa-edit"></i>Editar</a></td>
					<td><a class="botao2" acao="excluir" href="<?php echo INCLUDE_PATH_PAINEL;?>lista-propagandas?excluir=<?php echo $value['id'];?>"><i class="fas fa-trash-alt"></i>Excluir</a></td>
				</tr>
				<?php
					}
				?>
			</table>
		</div>
		<div class="paginas">
			<?php
				$totalpaginas = ceil(count(Painel::buscarinformacoes('propaganda')) / $cadapagina);
				for ($i = 1; $i <= $totalpaginas; $i++){
					if($i == $primeirapagina)
						echo '<a class="selecionado" href="'.INCLUDE_PATH_PAINEL.'lista-propagandas?pagina='.$i.'">'.$i.'</a>';
					else
						echo '<a href="'.INCLUDE_PATH_PAINEL.'lista-propagandas?pagina='.$i.'">'.$i.'</a>';
				}
			?>
		</div>
	</div>
</section>