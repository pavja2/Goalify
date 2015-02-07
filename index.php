<?php

// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->assign('name', 'Ned');
$smarty->display('index.tpl');

?>
