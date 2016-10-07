<html>
<head>
    <title> Let's try something </title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZdhbVuSEaqMWfsZroA-FLJIg-9-Jxh-U"></script>
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
        zoom:15,
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

      $('#geocoding_form').submit(function(e){
        e.preventDefault();
// geocoding: bring map to the address typed in the address text field
        GMaps.geocode({
          address: $('#address').val().trim(),
          callback: function(results, status){
            if(status=='OK'){
              var latlng = results[0].geometry.location;
              map.setCenter(latlng.lat(), latlng.lng());
              map.addMarker({
                lat: latlng.lat(),
                lng: latlng.lng(),
                title: $('#address').val().trim(),
                infoWindow: {
                   content: '<p>lat: ' + latlng.lat() + ' lng: ' + latlng.lng() + '</p>' }
                 });
               }
             }
           });
         });
       });
  </script>

</head>
<body>
<?php $errormsg="" ?>
<div id="hoverAddressBar">
<form method="post" id="geocoding_form">
  <label for="address">Address:</label>
    <input type="text" id="address" name="address" />
    <input type="submit"  value="Search" />
</form>
</div>

<div id="googlemaps"></div>

<div id="addplaces" >
  <p> <b>Add your places</b> </p>
  <p> <?php echo $errormsg; ?> </p>
  <form class="places" id="places_form" method="post">
    <label for="placename">Name:</label>
      <input type="text" id="placename" name="placename" />
    <label for="placeaddress"> Address:</label>
      <input type="text" id="placeaddress" name="placeaddress" />
    <label for="placedescipt">Description: </label>
      <input type="text" id="placedescript" name="placedescript" />

      <input type="submit" value="ADD" name="submit" />
  </form>
</div>

<?php
function push(){
    global $errormsg ;
  if ($_POST['placename'] == null) {
    $errormsg = "* Must have a name!";
    return;
  }
  elseif ($_POST['placeaddress'] == null) {
    $errormsg = "* Must have a address!";
    return;
  }
  else {
    // Do SQL Stuff
    // Creating connection to database
    $conn = new mysqli("localhost","root","password","places");
    // Check connection
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }
    $name = $_POST['placename'];
    $address = urlencode($_POST['placeaddress']);
    $descript = $_POST['placedescript'];
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';
    $geocode = file_get_contents($url);
    $results = json_decode($geocode, true);
    if ($results['status']=='OK') {
      $lat = $results['results'][0]['geometry']['location']['lat'];
      $lng = $results['results'][0]['geometry']['location']['lng'];
    }

    $sql="INSERT INTO placestable(name,address,descript,lat,lng)
    VALUES('$name','$address','$descript','$lat','$lng')";

    if($conn->query($sql)=== true) {
      echo "we did it yay!!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}
if (isset($_POST['submit'])) {
  push();
}
 ?>

</body>
</html>
