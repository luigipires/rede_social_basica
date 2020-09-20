<?php
	include('../config.php');

	if(Painel::login() == false){
		include('login.php');
	}else{
		include('home.php');
	}
?>