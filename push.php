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
?>
