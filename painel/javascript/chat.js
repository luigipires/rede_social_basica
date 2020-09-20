$(function(){

	$('.config-chat').scrollTop($('.config-chat')[0].scrollHeight);

	$('textarea').keyup(function(e){
		var codigo = e.keyCode || e.which;
		if(codigo == 13){
			mandarmensagem();
		}
	});

	$('form').submit(function(){
		mandarmensagem();
		return false;
	})

	function mandarmensagem(){
		var mensagem = $('textarea').val();
		$('textarea').val('');
		
		$.ajax({
			url:include_path_painel+'ajax/chat.php',
			method:'post',
			data:{'mensagem':mensagem,'acao':'mandarmensagem'}
		}).done(function(data){
			$('.config-chat').append(data);
			$('.config-chat').scrollTop($('.config-chat')[0].scrollHeight);
		});
	}

	setInterval(function(){
		recuperarmensagem();
	},2000);

	function recuperarmensagem(){
		$.ajax({
			url:include_path_painel+'ajax/chat.php',
			method:'post',
			data:{'acao':'recuperarmensagem'}
		}).done(function(data){
			$('.config-chat').append(data);
			$('.config-chat').scrollTop($('.config-chat')[0].scrollHeight);
		});
	}
})