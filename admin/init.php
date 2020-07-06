<?php 

	//routes
	$tml = "includes/templates/";
	$languages = "includes/languages/";
	$functions = "includes/functions/";
	$css = "layout/css/";
	$js = "layout/js/";
	$images = "../layout/images/";
	


	//incudes 
	include $functions . 'functions.php';
	include $languages . 'english.php';
    include 'connect.php';
	include $tml . 'header.php';
	if(!isset($noNavbar))
		{ include $tml . 'navbar.php';}
?>