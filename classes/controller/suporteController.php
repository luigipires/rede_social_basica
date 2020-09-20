<?php
	namespace controller;

	use \views\mainView;

	class suporteController{
		public function index(){
			mainView::render('suporte.php',['controllersuporte'=>$this],'paginas/includes/headerlogin.php');
		}
	}
?>