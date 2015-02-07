<?php
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';
/*$curl = curl_init();
$url = "https://api.dropbox.com/1/account/info";
curl_setopt_array($curl, array(
   CURLOPT_RETURNTRANSFER => 1,
   CURLOPT_URL => $url,
));
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$_GET['access_token']));
$result = curl_exec($curl);*/
$user = new User();
$user->setUserName($_GET['user_name']);
$user->setFirstName($_GET['first_name']);
$user->setLastName($_GET['last_name']);
$today = date("Y/m/d");
$user->setLastActive($today);
$user->setEmail($_GET['email']);
$user->setScore(0);
$user->setToken($_GET['access_token']);
$user->save();
echo $user->getId();