<?php
	namespace Views;


	class mainView{
		
		public static function render($fileName,$arr = [],$header = 'paginas/includes/header.php',$footer = 'paginas/includes/footer.php'){
			include($header);
			include('paginas/'.$fileName);
			include($footer);
			die();
		}

		public static $parametro = [];

		public static function colocaparametro($parametro){
			self::$parametro = $parametro;
		}
	}
?>