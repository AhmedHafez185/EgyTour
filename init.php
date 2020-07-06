<?php 
include 'conf.php';// Database Connection
$func = 'includes/functions/';  // Function directory
$tpl = 'includes/templates/'; //Template Directory
$css = 'layout/css/';       //CSS Directory
$js = 'layout/js/';       //js Directory
$images = 'data/uploaded/';       //images Directory
// Include All Important Files
include $func . 'function.php';
include $tpl . 'header.php';
//include Navbar except those include noVarBar Variable 
if(!isset($noNavbar))
{
	include $tpl . 'navBar.php';
}

