<?php
require_once '/var/www/vendor/autoload.php';
// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';

if(isset($_COOKIE['user_id'])){
    $userId = $_COOKIE['user_id'];
    $userQuery = new UserQuery();
    $user = $userQuery->findPK($userId);
    $campaignQuery = CampaignQuery::create()->filterByUserId($userId)->filterByCampaignStatusId(2)->find();
    if(sizeof($campaignQuery) > 0){//if this user has open campaigns
        
    }
}