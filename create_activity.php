<?php
//put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$smarty = new Smarty();

if(sizeof($_GET)> 0){
	$startDate = date($_GET['start_date']);
	$timedate = strtotime($_GET['end_date']);
	$endDate = date($timedate);
	//create their balance statement
	$balance = new Balance();
	$balance->setAmount($_GET['amount']);
	$balance->save();
	$campaign = new Campaign();
	$campaign->setBalanceId($balance->getId());
	$campaign->setUserId($_GET['user_id']);
	$campaign->setName($_GET['name']);
	$campaign->setBeginDate(date("Y/m/d"));
	$campaign->setEndDate($endDate);
	$campaign->setCampaignStatusId(2);
	$campaign->save();
}
else{
$smarty->display('createActivity.tpl');
}