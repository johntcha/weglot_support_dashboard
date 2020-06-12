<?php

require_once './vendor/autoload.php';

use HelpScout\Api\ApiClientFactory;
use HelpScout\Api\Users\UserFilters;
use HelpScout\Api\Reports\Company;


$appId = "app_id";
$appSecret = "app_secret";
$refreshToken = "refresh_token";

$client = ApiClientFactory::createClient();
$client->setAccessToken('access_token');
$client->useClientCredentials($appId, $appSecret);
$client->useRefreshToken($appId, $appSecret, $refreshToken);
//$client->getAuthenticator()->fetchAccessAndRefreshToken();

/*$client = $client->swapAuthorizationCodeForReusableTokens(
    $appId,
    $appSecret,
    $authorizationCode
);
$users = $client->users()->list();
/**
 * Refreshing an expired token
 */
/*$client->useRefreshToken(
    $appId,
    $appSecret,
    $refreshToken
);
$newTokens = $client->getAuthenticator()->fetchAccessAndRefreshToken()->getTokens();*/

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

$report = $client->runReport(Company\Overall::class, $params);

$json = json_encode($report);
$jsonarray = json_decode($json, true);
$data_actual_customer_name = $jsonarray["users"];

// rank the top sent messages
$sortArray = array();
foreach($data_actual_customer_name as $person){
    foreach($person as $key=>$value){
        if(!isset($sortArray[$key])){
            $sortArray[$key] = array();
        }
        $sortArray[$key][] = $value;
    }
}

$orderby = "replies";

array_multisort($sortArray[$orderby],SORT_DESC,$data_actual_customer_name);
$top = $data_actual_customer_name[0]["replies"];
$bottom = $data_actual_customer_name[6]["replies"];
$percentage = round($top/$bottom, 2);

// fill the table with names, nb of messages and customers helped
foreach  ($data_actual_customer_name as $values){
    if ($values["name"] !== "Elizabeth Pokorny" 
        & $values["name"] !== "Eugene Ernoult"
        & $values["name"] !== "Remy Berda"
        & $values["name"] !== "Laura Gutierrez"
        & $values["name"] !== "Meryl Csibra"
        & $values["name"] !== "Thomas Fanchin"
        & $values["name"] !== "Thibaud Guerin"
        & $values["name"] !== "Augustin Prot"
        & $values["name"] !== "Floran Pagliai"
    ) {
        echo '
        <tr>
           <td>'.$values["name"].'</td>
           <td>'.$values["replies"].'</td>
           <td>'.$values["customersHelped"].'</td>
        </tr>';
    }
}



