$(function(){
	$('.atualizar-config').sortable({
		start: function(){
			var el = $(this);
			el.find('.cliente:nth-of-type(1)').css('border','4px dashed #1A40C0');
		},
		update:function(event,ui){
			var data = $(this).sortable('serialize');
			var el = $(this);
			data+='&tipo_acao=ordenacao_empreendimentos';
			el.find('.cliente:nth-of-type(1)').css('border','3px solid #c11a26');
			$.ajax({
				url:include_path_painel+'ajax/formularios.php',
				method:'post',
				data:data
			}).done(function(){
				
			});
		},
		stop:function(){
			var el = $(this);
			el.find('.cliente:nth-of-type(1)').css('border','3px solid #c11a26');
		}
	});
)}