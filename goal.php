<?php

// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();
$goalId = $_GET["goalId"];
$campaignQuery = new CampaignQuery();
$goal = $campaignQuery->findPK($goalId);
$smarty->assign('goal', $goal);
$partnershipQuery = PartnershipQuery::create()->filterByCampaign($goal)->find();
$partnership = $partnershipQuery[0];
if($partnership->getUserId() == $_COOKIE["user_id"]){
    $smarty->assign('partnership', $partnership);
    $checkpointQuery = CheckpointQuery::create()->filterByCampaignId($goal->getId())->find();
    $smarty->assign('checkpoints', $checkpointQuery);
    $smarty->display('partner_goal.tpl');
}
else{
$smarty->display('goal.tpl');
}
?>
