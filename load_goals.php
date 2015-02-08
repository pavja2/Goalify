<?php

$user = $_GET[userId];

$q = new UserQuery();

$userCampaigns = array($q->findPK($user));

return $userCampaigns;

?>
