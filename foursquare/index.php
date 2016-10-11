<html>
<head>
<title>Search 4Square</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZdhbVuSEaqMWfsZroA-FLJIg-9-Jxh-U"></script>
 <script type="text/javascript" src="gmaps.js"></script>

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

<script type="text/javascript">
// create map
  $(document).ready(function(){
    var map = new GMaps({
        div: '#map',
        lat: 33,
        lng: -84,
        zoom:6,
      });
      <?php
      if ($_GET['query']&&$_GET['near']&&$_GET['radius']!="") {
          foreach ($items as $item) {
            echo "map.addMarker({\n";
            echo "lat:".$item['location']['lat'].",\n";
            echo "lng:".$item['location']['lng'].",\n";
            echo "title: '".addslashes($item['name'])."',\n";
            echo "infoWindow: {\n";
            echo "content: \n";
            // echo "'<p>place id: ".$item['id']."</p>'\n";
            echo " '<p>name: ".addslashes($item['name'])."</p>'\n";
            // echo " '<p>checkinsCount: ".$item['stats']['checkinsCount']."</p>'\n";
            // echo " '<p>address: ".addslashes($item['location']['address'])."</p>'\n";
            // echo " '<p>".$item['contact']['twitter']."</p>'\n";
            // echo " '<p>".$item['contact']['facebook']."</p>'\n";
            echo " }\n";
            echo "});\n";
          }
        }
         ?>
    });   // end of ready


</script>


</head>

<body>





<form action="" method="get">


  <br>Keyword:
	<input type="text" name="query"  style="width: 200px; height: 19px">
<br>Near:
<input type="text" name="near"  style="width: 200px; height: 19px">

<br> Radius (<100,000 meters):
<input type="text" name="radius"  style="width: 150px; height: 19px">

<br>

<input type="submit" value="Search (Foursquare API)"  style="width: 246px; height: 40px" />


</form>

<div id="map" style="width: 1019px; height: 622px"></div>


</body>
</html>
