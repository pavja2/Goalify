<?php
// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();
$userQuery = new UserQuery();
$user = $userQuery->findPK($_COOKIE['user_id']);
$partnershipQuery = PartnershipQuery::create()->filterByPartnerId($user->getId())->find();
$smarty->assign('partnerList', $partnershipQuery);
$smarty->display('partnerships.tpl');
?>
