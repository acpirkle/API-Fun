<?php
$client_id = 'QUJM5BB4411C4YCXWRTHPGOA0EK1RWI5N1Y35RGZ2WD1NTBG';
$client_secret = '0JJ23YB5HZGU14DZXF42J4NNHTEK1KB0QXJ1AXGITAVQBGX4';

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
