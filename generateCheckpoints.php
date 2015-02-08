<?php
// put full path to Smarty.class.php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)
{
    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    $dateArr = array();

    do
    {
        if(date("w", $startDate) != $weekdayNumber)
        {
            $startDate += (24 * 3600); // add 1 day
        }
    } while(date("w", $startDate) != $weekdayNumber);


    while($startDate <= $endDate)
    {
        $dateArr[] = date('Y-m-d', $startDate);
        $startDate += (7 * 24 * 3600); // add 7 days
    }

    return($dateArr);
}
$campaignId = $_GET["campaign_id"];
$startDate = $_GET["start_date"];
$endDate = $_GET["end_date"];
$dayofweek = date('w', strtotime($_GET["start_date"]));
$campaignQuery = new CampaignQuery();
$campaign = $campaignQuery->findPK($campaignId);
$dateArr = getDateForSpecificDayBetweenDates($_GET["start_date"], $_GET["end_date"], $dayofweek);
foreach ($dateArr as $date) {
    $checkpoint = new Checkpoint();
    $checkpoint->setCampaign($campaign);
    $checkpoint->setDate($date);
    $checkpoint->setCompleted(false);
    $checkpoint->save();
}
