<?php
require_once('TwitterAPIExchange.php');
require('index.html');

//Set access tokens
$settings = array(
  'oauth_access_token' => "***",
  'oauth_access_token_secret' => "***",
  'consumer_key' => "***",
  'consumer_secret' => "***"
);

//URL and Request Method
$url="https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";

if (isset($_GET['search'])) {
// start grabbing data from form
$name = $_GET['hashtag'];


// if 'lat', 'lng', and 'range' textboxes are filled up set them in $getfield
if(!empty($_GET['lat'])&& !empty($_GET['lng'])&& !empty($_GET['range'])){
  $getfield = "?q=".$name."&geocode=".$_GET['lat'].",".$_GET['lng'].",".$_GET['range']."mi";
  $getfield.="&count=100";
}
// else just set query and add count=100
else {
  $getfield = "?q=".$name;
  $getfield.="&count=100";
}
}

$twitter = new TwitterAPIExchange($settings);
// echo $twitter->setGetfield($getfield)
//     ->buildOauth($url, $requestMethod)
//     ->performRequest();

$string = json_decode($twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest(),TRUE);
//for searching array
 // echo "<pre>";
 // print_r($string);
 // echo "</pre>";

if (isset($string['statuses'])) {


 foreach ($string['statuses'] as $post) {
   $norm = $post['user']['profile_image_url_https'];
   $imgURL = str_replace("_normal","",$norm);
   echo "<div class=\"posts container\">";
   echo "<img src=".$imgURL."><br/>";
   echo "username: @".$post['user']['screen_name']."<br/>";
   echo "Time and Date of Tweet: ".$post['created_at']."<br/>";
   echo "Tweet: ".$post['text']."<br/>";
   echo "Source: ".$post['source']."<br/>";
   echo "Geo Location: ".$post['geo']['coordinates'][0]." ".$post['geo']['coordinates'][1]."<br/>";
   echo "Place: ".$post['place']['full_name']."<br/>";
   echo "Tweeted by: ".$post['user']['name']."<br/>";
   echo "Followers: ".$post['user']['followers_count']."<br/>";
   echo "Friends: ".$post['user']['friends_count']."<br/>";
   echo "Listed: ".$post['user']['listed_count']."<br/>";
   echo "</div>";
   echo "<br/>";
 }
}

?>
