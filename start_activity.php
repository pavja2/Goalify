<?php
//put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';


$campaign = new Campaign();
$campaign->setUserId($_GET['user_id']);
$campaign->setName($_GET['name']);
$today= date("Y-m-d H:i:s");
$campaign->setBeginDate($today);
$campaign->setEndDate($_GET['end_date']);
$campaign->setCampaignStatusId(2);

$campaign->save();
?>
