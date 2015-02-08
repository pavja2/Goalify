<?php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';

$balance = new Balance();
$balance->setAmount($_GET['amount']);
$balance->setPaymentInfo($_GET['payment_info']);
$balance->save();

$id = $balance->getId();

$campaign = CampaignQuery::create()
->orderById('desc')
->findOne();


$campaign->setBalanceId($id);
$campaign->save();

?>
~     
