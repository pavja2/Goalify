<?php
require('/var/www/smarty/Smarty.class.php');
require_once '/var/www/vendor/autoload.php';

// setup Propel
require_once '/var/www/vendor/propel/schemas/generated-conf/config.php';


require_once('/var/www/vendor/stripe/stripe-php/lib/Stripe.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account
Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];

$error = false;
// Create the charge on Stripe's servers - this will charge the user's card
try {
$charge = Stripe_Charge::create(array(
  "amount" => $_GET['amount'], // amount in cents, again
  "currency" => "usd",
  "card" => $token,
  "description" => "payinguser@example.com")
);

} catch(Stripe_CardError $e) {
  // The card has been declined
}
if(!error || error ){//we'd remove in production but don't care about card validity right now
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
}
?>
~     
