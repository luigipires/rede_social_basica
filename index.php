<?php
	include('config.php');

	$homeController = new controller\homeController();
	$userController = new controller\userController();
	$comunidadeController = new controller\comunidadeController();
	$solicitacaoController = new controller\solicitacoesController();
	$suporteController = new controller\suporteController();
	$respostasuporteController = new controller\respostasuporteController();
	$adminController = new controller\adminController();
	$perfilController = new controller\perfilController();

	Router::get('/',function() use ($homeController){
		$homeController->index();
	});

	Router::get('/user',function() use ($userController){
		$userController->index();
	});

	Router::get('/comunidade',function() use ($comunidadeController){
		$comunidadeController->index();
	});

	Router::get('/solicitacao',function() use ($solicitacaoController){
		$solicitacaoController->index();
	});

	Router::get('/suporte',function() use ($suporteController){
		$suporteController->index();
	});

	Router::get('/respostasuporte',function() use ($respostasuporteController){
		if(isset($_GET['token'])){
			if($respostasuporteController->pegartoken()){
				$respostasuporteController->index();
			}else{
				die('A pergunta não existe!');
			}
		}else{
			die('Você precisa do token para visualizar a pergunta!');
		}
	});

	Router::get('/admin',function() use ($adminController){
		$adminController->index();
	});

	Router::get('/perfil/?',function($parametro) use ($perfilController){
		$perfilController->index($parametro);
	});
?>


