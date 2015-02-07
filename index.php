<?php

// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();
if(!isset($_COOKIE['user_id'])){
$smarty->display('index.tpl');
}
else{
    $smarty->display('my_profile.tpl');
}
