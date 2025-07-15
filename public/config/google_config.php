<?php
require_once '../vendor/autoload.php'; // Certifique-se de rodar `composer require google/apiclient`

$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('http://localhost/spartask/assets/php/google_callback.php');
$client->addScope('email');
$client->addScope('profile');
?>
