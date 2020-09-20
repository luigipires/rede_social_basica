$(function(){
	//máscaras p/ cpf e cnpj
	$('[name=cpf]').mask('999.999.999-99');
	$('[name=cnpj]').mask('99.999.99/9999-99');

	$('[name=tipo_cliente]').change(function(){
		var valor = $(this).val();
		if(valor == '0'){
			$('[name=cpf]').parent().show();
			$('[name=cnpj]').parent().hide();
		}else{
			$('[name=cpf]').parent().hide();
			$('[name=cnpj]').parent().show();
		}
	});

	$('.ajax').ajaxForm({
		dataType:'json',
		beforeSend:function(){
			$('.ajax').animate({'opacity':'0.3'});
			$('.ajax').find('input[type=submit]').attr('disabled','true');
		},
		success: function(data){
			$('.ajax').animate({'opacity':'1'});
			$('.ajax').find('input[type=submit]').removeAttr('disabled');
			$('.sucesso').remove();
			$('.erro').remove();
			if(data.sucesso){
				$('.ajax').prepend('<div class="sucesso">'+data.erros+'</div>');
				if($('.ajax').attr('atualizar') == undefined)
					$('.ajax')[0].reset();
			}else{
				$('.ajax').prepend('<div class="erro">Erro no cadastro do cliente! <b>'+data.erros+'</b></div>');
			}
		}
	});

	$('.botaocliente2').click(function(){
		var excluir = $(this).attr('excluir');
		var elemento = $(this).parent().parent();
		$.ajax({
			url:include_path_painel+'ajax/excluir.php',
			data:{id:excluir},
			method:'post'
		}).done(function(){
			elemento.fadeOut();
		})
		return false;
	})
})
