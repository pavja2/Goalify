<?php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();
$smarty->display('uploadProof.tpl');