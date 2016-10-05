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
  <form class="places" id="places_form" method="post">
    <label for="placename">Name:</label>
      <input type="text" id="placename" name="placename" />
    <label for="placeaddress"> Address:</label>
      <input type="text" id="placeaddress" name="placeaddress" />
    <label for="placedescipt">Description: </label>
      <input type="text" id="placedescript" name="placedescript" />

      <input type="submit" value="ADD" />
  </form>
</div>

</body>
</html>
