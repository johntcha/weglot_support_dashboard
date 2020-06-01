<?php
require('./chartmogul/vendor/autoload.php');

ChartMogul\Configuration::getDefaultConfiguration()
    ->setAccountToken('account_token')
    ->setSecretKey('secret_token');
//print_r(ChartMogul\Ping::ping()->data);

$actual_month = date('n');

//determine the previous quarter according to the date today
if ($actual_month >4 && $actual_month <9){ //Quarter 2
	if($actual_month == 5){
		$first_day = date('Y-m-t',strtotime("today - 5 month"));
	}
	elseif($actual_month == 6){
		$first_day = date('Y-m-t',strtotime("today - 6 month"));
	}
	elseif($actual_month == 7){
		$first_day = date('Y-m-t',strtotime("today - 7 month"));
	}
	elseif($actual_month == 8){
		$first_day = date('Y-m-t',strtotime("today - 8 month"));
	}
$last_day = date('Y-m-d',strtotime("april"));

}

elseif($actual_month >9 && $actual_month <=12){ //Quarter 3
	$first_day = date('Y-m-d',strtotime("first day of september"));
	$last_day = date('Y-m-d',strtotime("december"));
}

elseif($actual_month >=1 && $actual_month <5){ // Quarter 1
	$first_day = date('Y-m-d',strtotime("first day of january"));
	$last_day = date('Y-m-d',strtotime("last day of april"));
}

else{
	echo "error";
}


$quarter = ChartMogul\Metrics::mrr([
    "start-date" => "$first_day",
    "end-date" => "$last_day",
    "interval" => "month"
]);
 
//Calculate the year quarter.
$yearQuarter = ceil($actual_month / 3);
 
//Print it out
echo "We are currently in Quarter $yearQuarter of " . date("Y");
echo "</br>";

//print_r($quarter_data = $quarter->entries->toArray());
$quarter_data = $quarter->entries->toArray();
$total_churn = 0;
$total_react = 0;

//this week
$first_day_w = date("Y-m-d",strtotime('last monday', strtotime('tomorrow')));
$last_day_w = date("Y-m-d");

$week = ChartMogul\Metrics::mrr([
    "start-date" => "$first_day_w",
    "end-date" => "$last_day_w",
    "interval" => "month"
]);

//print_r($week_data = $quarter->entries->toArray());
$week_data = $quarter->entries->toArray();

?>