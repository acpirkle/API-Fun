<?php
require 'push.php';

if (isset($_POST['submit'])) {
  push();
}
// create connection to database
$conn = new mysqli("localhost","root","password","places");
// if searchbox is set search for the keyword in the database else display all markers
if (isset($_GET['searchbox']) && $_GET['searchbox'] !='') {
  $key = $_GET['searchbox'];
  $sql = "SELECT * FROM placestable WHERE descript LIKE '%$key%' ";
  $_GET = '';
}
else {
  $sql = "SELECT * FROM placestable";
}

$result = mysqli_query($conn, $sql);

$sqlArray = array();

while ($row = mysqli_fetch_assoc($result)) {
  $sqlArray[] = $row;
}

//echo json_encode($sqlArray);

mysqli_close($conn);

$howbig = count($sqlArray);
?>

<html>

<head>
    <title> My Favorite Places </title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=***"></script>
  <script type="text/javascript" src="gmaps.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css">

  <script type="text/javascript">
// create map
  $(document).ready(function(){
      var map = new GMaps({
        div: '#googlemaps',
        lat: 40.4406,
        lng: -79.9959,
        zoom:8,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
          mapTypeIds: ['roadmap', 'satellite'],
          position: google.maps.ControlPosition.RIGHT_BOTTOM
        },
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_BOTTOM
        },
        streetViewControl: false,
      });

// try geolocate if not stay at pittsberg PA
      GMaps.geolocate({
        success: function(position){
          map.setCenter(position.coords.latitude, position.coords.longitude);

          map.addMarker({
            lat: position.coords.latitude,
            lng: position.coords.longitude,
            title: 'You are here.',
            infoWindow: {
              content: '<p>You are here!</p>'
            }
          });
        },

       error: function(error){
          alert('Geolocation failed: '+error.message);
        },

       not_supported: function(){
          alert("Sorry! I cant See You!");
        }
      });
      <?php


      for ($x=0; $x < $howbig; $x++) {
          echo "map.addMarker({\n";
          echo "lat:".$sqlArray[$x]['lat'].",\n";
          echo "lng:".$sqlArray[$x]['lng'].",\n";
          echo "title: '".$sqlArray[$x]['name']."',\n";
          echo "infoWindow: {\n";
          echo "content: '<p>".$sqlArray[$x]['descript']."</p>' }\n";
          echo "});\n";
      }
      ?>

     });

  </script>


</head>
<body>
<?php $errormsg="" ?>

<div id="googlemaps"></div>

<div id="addplaces" >
  <h4 style="text-align: center;"> <b>Add your places</b> </h4>
  <p> <?php echo $errormsg; ?> </p>
  <form class="places" id="places_form" method="post">
    <p><label for="placename">Name:</label>
      <input type="text" id="placename" name="placename" /></p></br>
    <p><label for="placeaddress"> Address:</label>
      <input type="text" id="placeaddress" name="placeaddress" /></p></br>
    <p><label for="placedescipt">Description: </label>
      <input type="text" id="placedescript" name="placedescript" />
      <input type="submit" value="ADD" name="submit" /></p>
  </form>
  <div id="searchkeywords">
    <form class="search" id="search" method="get">
      <input type="text" id="searchbox" name="searchbox"/>
      <input type="submit" id="searchbttn" name="searchbttn" value="SEARCH"/>
    </form>
  </div>
</div>

</body>
</html>
