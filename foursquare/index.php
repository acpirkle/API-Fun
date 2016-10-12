<html>
<head>
<title>Search 4Square</title>
<?php require('searchFS.php') ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZdhbVuSEaqMWfsZroA-FLJIg-9-Jxh-U"></script>
 <script type="text/javascript" src="gmaps.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="foursquare.css" type="text/css">

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




<div class="foursquareSearch form-group">
  <form action="" method="get">
    <label for="query">Keyword:</label>
      <input type="text" class="form-control" name="query" id="query"/><br/>
    <label for="near">Near:</label>
      <input type="text" class="form-control" name="near" id="near"/><br/>
    <label for="radius">Radius (< 100,000 meters):</label>
      <input type="text"  class="form-control" name="radius"  id="radius"/><br/>
      <input type="submit" class="btn btn-default" value="Search (Foursquare API)"/>
    </form>
</div>

<div class="map container" id="map"></div>


</body>
</html>
