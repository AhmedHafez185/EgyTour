<?php
$noNavbar = '';
include "init.php";
session_start();	// Start Session 
session_unset();   // unset data or variable
session_destroy(); // Destroy the session
header('Location: index.php');
exit();
include $tpl . 'FooterNoNav.php'?>