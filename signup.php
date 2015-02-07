<?php

// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();

if(sizeof($_GET) > 0){
	$smarty->display('signup.tpl');
}
else{
	$user = new User();
	$user->setName($_GET['username']);
	$user->setFirstName($_GET['firstname']);
	$user->setLastName($_GET['lastname']);
	$today = date("Y/m/d");
	$user->setLastActive($today);
	$user->setEmail($_GET['email']);
	$user->setScore(0);
}