<?php

// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$user = new User();
$user->setUserName('Name');
$user->save();


$smarty = new Smarty();
$smarty->assign('name', 'Ned');
$smarty->display('index.tpl');
?>
