$(function(){
	$('.ajax').ajaxForm({
		dataType:'json',
		beforeSend:function(){
			$('.ajax').animate({'opacity':'0.4'});
			$('.ajax').find('input[type=submit]').attr('disabled','true');
		},
		success:function(data){
			$('.ajax').animate({'opacity':'1'});
			$('.ajax').find('input[type=submit]').removeAttr('disabled');
			$('.sucesso').remove();
			$('.erro').remove();
			if(data.sucesso){
				$('.ajax').prepend('<div class="sucesso">'+data.mensagem+'</div>');
			}else{
				$('.ajax').prepend('<div class="erro">'+data.mensagem+'</div>');
			}
		}
	})
})