$(function(){
	$('td[dia]').click(function(){
		$('td').removeClass('diaselect');
		$(this).addClass('diaselect');
		var novodia = $(this).attr('dia').split('-');
		var novodia = novodia[2]+'/' + novodia[1]+'/' + novodia[0];

		mudadata($(this).attr('dia'),novodia);
		eventos($(this).attr('dia'));
	})

	function mudadata(naoformatar,formatar){
		$('input[name=data]').attr('value',naoformatar);
		$('form h4').html('Adicionar tarefa para '+formatar);
		$('.box-tarefas h2').html('Tarefas para '+formatar);
	}

	function eventos(data){
		$('.tarefas').remove();
		$.ajax({
			url:include_path_painel+'ajax/calendario.php',
			method:'post',
			data:{'data':data,'addtarefa':'puxar'}
		}).done(function(data){
			$('.box-tarefas h2').after(data);
		})
	}

	$('form').ajaxForm({
		dataType:'json',
		success:function(data){
			$('.sucesso').remove();
			$('form').after('<div class="sucesso">Tarefa adicionada com sucesso!</div>');
			$('.box-tarefas h2').after('<div class="tarefas"><p>'+data.tarefa+'</p></div>');
			$('form')[0].reset();
		}
	})
})