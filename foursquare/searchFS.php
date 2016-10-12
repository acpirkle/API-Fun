<?php
$client_id = '***';
$client_secret = '***';

if (isset($_GET['query'],$_GET['near'],$_GET['radius'])) {
  if ($_GET['query']&&$_GET['near']&&$_GET['radius']!="") {
$url = 'https://api.foursquare.com/v2/venues/search'; //set the resource link
//set Get parameters
$url .= '?query='.urlencode($_GET['query']);
$url .= '&near='.urlencode($_GET['near']);
$url .= '&radius='.$_GET['radius'];
$url .= '&client_id='.$client_id;
$url .= '&client_secret='.$client_secret;
$url .= '&v='.date("Ymd"); //specify today's date

$file = file_get_contents($url);
$data = json_decode($file,true);
$items = $data['response']['venues'];
$size = count($items);

//for searching array
// echo "<pre>";
// print_r($data);
// echo "</pre>";
}
}
?>
