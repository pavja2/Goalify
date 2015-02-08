<?php

require_once '/var/www/vendor/autoload.php';
// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
$userQuery = UserQuery::create()->find();
foreach ($userQuery as $user) {
    $foundMatch = false;
    $userId = $user->getId();
    $campaignQuery = CampaignQuery::create()->filterByUserId($userId)->filterByCampaignStatusId(2)->find();
    if (sizeof($campaignQuery) > 0) {
        //if this user has open campaigns
        foreach ($campaignQuery as $campaign) {
            $matchedCampaignQuery = CampaignQuery::create()->filterByCampaignStatusId(2)->find();
            foreach ($matchedCampaignQuery as $potentialMatch) {
                if ($potentialMatch->getUserId() != $user->getId()) {
                    $matchedCampaign = $potentialMatch;
                    $foundMatch = true;
                    break;
                }
            }
            if ($foundMatch && $matchedCampaign->getUserId() != NULL) {
                $partnerId = $matchedCampaign->getUserId();
                echo $matchedCampaign;
                $partnerQuery = new UserQuery();
                $partner = $partnerQuery->findPK($partnerId);
                mail($partner->getEmail(), "Accountability Partner Found for " + $matchedCampaign->getName(), "Contact your accountability partner via " + $partner->getEmail());
                mail($user->getEmail(), "Accountability Partner Found for " + $campaign->getName(), "Contact your accountability partner via " + $user->getEmail());
                $partnership = new Partnership();
                $partnership->setUserId($user->getId());
                $partnership->setPartnerId($partner->getId());
                $partnership->setCampaignId($campaign->getId());
                $reversePartnership = new Partnership();
                $reversePartnership->setUserId($partner->getId());
                $reversePartnership->setPartnerId($user->getId());
                $reversePartnership->setCampaignId($matchedCampaign->getId());
                $partnership->save();
                $reversePartnership->save();
                $campaign->setCampaignStatusId(1);
                $campaign->save();
                $matchedCampaign->setCampaignStatusId(1);
                $matchedCampaign->save();
            } else {
                echo "No match found.";
            }
        }
    }
}