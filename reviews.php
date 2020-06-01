<?php
include 'simple_html_dom.php';
//Total reviews
$html_trust = file_get_html('https://fr.trustpilot.com/review/weglot.com', false);
$review_trust = $html_trust->find('span[class="headline__review-count"]',0)->plaintext;


$html_shop = file_get_html('https://apps.shopify.com/weglot?locale=fr', false);
$review_shop = $html_shop->find('span[class="ui-review-count-summary"]',0)->plaintext;
$review_shop = substr($review_shop,1,3);


$html_word = file_get_html('https://wordpress.org/support/plugin/weglot/reviews/', false);
$review_word = $html_word->find('div[class="reviews-total-count"]',0)->plaintext;
$review_word = substr($review_word,0,5);
$review_word = str_replace(",", "", "$review_word");

$total_all = $review_word + $review_shop + $review_trust;

////////////////////////////SHOPIFY REVIEWS////////////////////////////////////
$html_shop_w = file_get_html('https://apps.shopify.com/weglot/reviews', false);
$list_shop_w = $html_shop_w->find('div[class="review-metadata__item-value"]');



for ($i = 0; $i < sizeof($list_shop_w); $i++){
	if ($i%2 == 0) {	
	$reviews_list_shop[] = $list_shop_w[$i+1]->plaintext;//we only get dates here

	}		
}

$stars_Shop = $html_shop_w->find('div[class="ui-star-rating"]');
$DataRating = "data-rating";
$stars_Shop_filtered = array_slice($stars_Shop, 5); 
for ($i = 0; $i < sizeof($stars_Shop_filtered); $i++){
	$reviews_stars_shop[] = $stars_Shop_filtered[$i]->$DataRating;
}


//count number of 5 stars on Shopify each week from the last Monday 00:00:00
function count_review_Shopify($list1, $list2){//$list1 = dates  $list2 = stars
$mondays_start=strtotime('last monday + 2 hour', strtotime('tomorrow'));
$p=0;
for ($k = 0; $k < sizeof($list1); $k++){
	
	$dates_shop = strtotime($list1[$k].'+ 2 hour');
	if ($dates_shop >= $mondays_start & $list2[$k] == "5"){
		$p+=1;
	}
		
}
return $p;
}

$shopp = count_review_Shopify($reviews_list_shop, $reviews_stars_shop);



////////////////////////////WORDPRESS REVIEWS////////////////////////////////////
$html_word_w = file_get_html('https://wordpress.org/support/plugin/weglot/reviews/', false);
$list_word_w = $html_word_w->find('li[class="bbp-topic-freshness"] a');

for ($i = 0; $i < sizeof($list_word_w); $i++){
	if ($i%2 == 0){	
		$reviews_list_word[] = $list_word_w[$i]->plaintext;	

	}		
}

$stars_WP = $html_word_w->find('div[class="wporg-ratings"]');
$stars_WP_filtered = array_slice($stars_WP, 1);
for ($i = 0; $i < sizeof($stars_WP_filtered); $i++){
	 $reviews_stars_word[] = $stars_WP_filtered[$i]->title;
}


//count number of 5 stars on WordPress each week from the last Monday 00:00:00
function count_review_WordPress($list1, $list2){//$list1 = dates  $list2 = stars
$p=0;
$day_today= date("l",strtotime(date("Y:m:d h:m:s")));//get the name of the date today
	for ($k = 0; $k < sizeof($list1); $k++){
		if ($day_today == "Monday" & $list2[$k] == "5 out of 5 stars"){ // $k+1 because we have the average 
		//total reviews at $k=0
			if( strstr($list1[$k], "1 day")==true) {
			}
			elseif(strstr($list1[$k], "2 days")==true){
			}
			elseif(strstr($list1[$k], "3 days")==true){
			}
			elseif(strstr($list1[$k], "4 days")==true){
			}
			elseif(strstr($list1[$k], "5 days")==true){
			}
			elseif(strstr($list1[$k], "6 days")==true){
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Tuesday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "2 day")==true) {
			}
			elseif(strstr($list1[$k], "3 days")==true){
			}
			elseif(strstr($list1[$k], "4 days")==true){
			}
			elseif(strstr($list1[$k], "5 days")==true){
			}
			elseif(strstr($list1[$k], "6 days")==true){
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Wednesday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "3 day")==true) {
			}
			elseif(strstr($list1[$k], "4 days")==true){
			}
			elseif(strstr($list1[$k], "5 days")==true){
			}
			elseif(strstr($list1[$k], "6 days")==true){
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Thursday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "4 day")==true) {
			}
			elseif(strstr($list1[$k], "5 days")==true){
			}
			elseif(strstr($list1[$k], "6 days")==true){
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Friday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "5 day")==true) {
			}
			elseif(strstr($list1[$k], "6 days")==true){
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Saturday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "6 day")==true) {
			}
			elseif(strstr($list1[$k], "7 days")==true){
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
		elseif($day_today == "Sunday" & $list2[$k] == "5 out of 5 stars"){

			if( strstr($list1[$k], "7 day")==true) {
			}
			elseif(strstr($list1[$k], "week")==true){
			}
			elseif(strstr($list1[$k], "weeks")==true){
			}
			elseif(strstr($list1[$k], "month")==true){
			}
			elseif(strstr($list1[$k], "months")==true){
			}
			elseif(strstr($list1[$k], "year")==true){
			}
			elseif(strstr($list1[$k], "years")==true){
			}
			else{
				$p+=1;
			}
		}
	}
return $p;
}

$wordp = count_review_WordPress($reviews_list_word, $reviews_stars_word);








