<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require './autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AfCRd3HhztLS7uh_bL4biB5vqSQYoUcDNY-dA8muvYvDQn6i-FDSqDoL5nZR15U_JuvYYJZd8I3k98v_',
    'client_secret' => 'ENVJ7cfIM_gK1qHxjNb-ujZglD15KNL7z0nGXSZKQxABy5WcKH8FcrmOsdj_XJ1IB7IvaSg9tVgH0IvX',
    'return_url' => 'http://localhost/projects/project/payment/response.php',
    'cancel_url' => 'http://localhost/projects/project/payment/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'project'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

// /**
//  * Set up a connection to the API
//  *
//  * @param string $clientId
//  * @param string $clientSecret
//  * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
//  * @return \PayPal\Rest\ApiContext
//  */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
