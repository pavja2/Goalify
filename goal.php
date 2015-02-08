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
$balanceId = $goal->getBalanceId();
$balanceQuery = new BalanceQuery();
$balance = $balanceQuery->findPK($balanceId);
$smarty->assign('balance', $balance);
$partnershipQuery = PartnershipQuery::create()->filterByCampaignId($goalId)->find();
$partnership = $partnershipQuery[0];
$checkpointQuery = CheckpointQuery::create()->filterByCampaignId($goalId)->find();
$smarty->assign('checkpoints', $checkpointQuery);

if(isset($_GET["partner"])){
    $smarty->display('partner_goal.tpl');
}
else{
$smarty->display('goal.tpl');
}
?>
