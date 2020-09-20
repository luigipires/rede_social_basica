$(function(){
	var aberto = true;
	var tamanhotela = $(window)[0].innerWidth;
	var tamanhomenu = (tamanhotela <= 400) ? 200 : 250;

	if(tamanhotela <= 768){
		aberto = false;
	}

	$('header h3').click(function(){
		if(aberto){
			$('aside').css('display','none');
			$('aside').animate({'width':0},function(){
				aberto = false;
			});
			$('header').animate({'left':0},function(){
				aberto = false;
			});
			$('header').css('width','100%');
			$('.sessao').animate({'left':0},function(){
				aberto = false;
			});
			$('.sessao').css('width','100%');
			$('.sessao01').animate({'left':0},function(){
				aberto = false;
			});
			$('.sessao01').css('width','100%');
		}else{
			$('aside').css('display','block');
			$('aside').animate({'width':+tamanhomenu+'px'},function(){
				aberto = true;
			});
			$('header').animate({'left':+tamanhomenu+'px'},function(){
				aberto = true;
			});
			$('header').css('width','calc(100% - 250px)');
			$('.sessao').animate({'left':+tamanhomenu+'px'},function(){
				aberto = true;
			});
			$('.sessao').css('width','calc(100% - 250px)');
			$('.sessao01').animate({'left':+tamanhomenu+'px'},function(){
				aberto = true;
			});
			$('.sessao01').css('width','calc(100% - 250px)');
		}
	})

	$('[acao=excluir]').click(function(){
		var confirmacao = confirm('Deseja excluir esse item?');
		var identificador = $(this).attr('identificador');
		if(confirmacao == true){
			return true;
		}else{
			return false;
		}
	});

	$('[name=tipo_empreendimento]').change(function(){
		var valor = $(this).val();
		if(valor == 'residencial'){
			$('[name=residencial]').parent().show();
			$('[name=comercial]').parent().hide();
		}else{
			$('[name=residencial]').parent().hide();
			$('[name=comercial]').parent().show();
		}
	});

	$('[name=tipo_imovel]').change(function(){
		var valor = $(this).val();
		if(valor == 'venda'){
			$('[name=venda]').parent().show();
			$('[name=aluguel]').parent().hide();
		}else{
			$('[name=venda]').parent().hide();
			$('[name=aluguel]').parent().show();
		}
	});

	$('[name=negocio]').change(function(){
		var valor = $(this).val();
		if(valor == 'apartamento'){
			$('[name=apartamento]').parent().show();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'box'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().show();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'casa'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().show();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'cobertura'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().show();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'kitnet'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().show();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'loja'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().show();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'pavilhao'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().show();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'salacomercial'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().show();
			$('[name=terreno]').parent().hide();
		}else if(valor == 'terreno'){
			$('[name=apartamento]').parent().hide();
			$('[name=box]').parent().hide();
			$('[name=casa]').parent().hide();
			$('[name=cobertura]').parent().hide();
			$('[name=kitnet]').parent().hide();
			$('[name=loja]').parent().hide();
			$('[name=pavilhao]').parent().hide();
			$('[name=salacomercial]').parent().hide();
			$('[name=terreno]').parent().show();
		}
	});

	$('[name=preco]').maskMoney({prefix:'R$ ',allowNegative:true,thousands:'.',decimal:',',affixesStay:false});
	$('[name=valor_empreendimento]').maskMoney({prefix:'R$ ',allowNegative:true,thousands:'.',decimal:',',affixes:false});
})