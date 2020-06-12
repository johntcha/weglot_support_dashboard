<?php
require_once './vendor/autoload.php';

use HelpScout\Api\ApiClientFactory;
use HelpScout\Api\Customers\CustomerFilters;
use HelpScout\Api\Conversations\ConversationFilters;
use HelpScout\Api\Conversations\ConversationRequest;
use HelpScout\Api\Users\UserFilters;
use HelpScout\Api\Reports\Company;

$appId = "app_id";
$appSecret = "app_secret";
$refreshToken = "refresh_token";

$client = ApiClientFactory::createClient();
$client->setAccessToken("access_token");
$client->useClientCredentials($appId, $appSecret);
$client->useRefreshToken($appId, $appSecret, $refreshToken);

/**
 * Refreshing an expired token
 */
/*$client->useRefreshToken(
    $appId,
    $appSecret,
    $refreshToken
);
$newTokens = $client->getAuthenticator()->fetchAccessAndRefreshToken()->getTokens();*/


//From Monday to today
$start = date('Y-m-d\TH:m:s\Z',strtotime('monday this week'));
$end   = date('Y-m-d\TH:m:s\Z',strtotime('now'));
$start_last = date('Y-m-d\TH:m:s\Z',strtotime('monday this week  -7 days'));
$end_last  = date('Y-m-d\TH:m:s\Z',strtotime('last sunday'));


$params = [
    'start' => $start,
    'end' => $end,
    'previousStart' => $start_last,
    'previousEnd' => $end_last,
    'types' => 'email'
];


//results
$report = $client->runReport(Company\Overall::class, $params);

$json = json_encode($report);
$jsonarray = json_decode($json, true);

$data_this_week_customer = $jsonarray["current"]["customersHelped"];
$data_last_week_customer = $jsonarray["previous"]["customersHelped"];
$data_this_week_msg = $jsonarray["current"]["totalReplies"];
$data_last_week_msg = $jsonarray["previous"]["totalReplies"];

$helped_this_week = strval($data_this_week_customer);
$helped_last_week = strval($data_last_week_customer);

$msg_this_week = strval($data_this_week_msg);
$msg_last_week = strval($data_last_week_msg);