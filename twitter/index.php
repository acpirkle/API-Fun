<html>
  <head>
    <?php
      require_once('TwitterAPIExchange.php');

      //Set access tokens
      $settings = array(
        'oauth_access_token' => "1242652957-2h0CyR3Ui4uzaw8oG2j4pkicjQK3SWNpwdC5uT1",
        'oauth_access_token_secret' => "3eDZCVXcDSwLVn2qLaHYh7AYgMLZRLaAAwpD5CsT2mTmt",
        'consumer_key' => "qe7CwUh28yMrK9mMiwlmVDnMv",
        'consumer_secret' => "6NXwfbPgnrUrhddr639VWYjQPHO5q8PlZAXHrXYsN8f3CUb2in"
      );

      //URL and Request Method
      $url="https://api.twitter.com/1.1/search/tweets.json";
      $requestMethod = "GET";

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

      $twitter = new TwitterAPIExchange($settings);
      // echo $twitter->setGetfield($getfield)
      //     ->buildOauth($url, $requestMethod)
      //     ->performRequest();

      $string = json_decode($twitter->setGetfield($getfield)
              ->buildOauth($url, $requestMethod)
              ->performRequest(),TRUE);

      echo "<pre>";
      print_r($string);
      echo "</pre>";


    ?>

  </head>
  <body>
    <div name="twitterSearch" id="twitterSearch">
      <form method="get" action="">
	       <br>Specify the hashtag you want to search by (starting with #): <br><br>&nbsp;<input name="hashtag" type="text" style="width: 239px; height: 30px" /><br>
         <br>Lat: <br><br>&nbsp;<input name="lat" type="text" style="width: 164px; height: 30px" /><br>
         <br>Lng: <br><br>&nbsp;<input name="lng" type="text" style="width: 161px; height: 30px" /><br>
         <br>Range (mile): <br><br>&nbsp;<input name="range" type="text" style="width: 53px; height: 30px" /><br>
         <br>&nbsp;<input type="submit" value="search tweets" />
      </form>
    </div>
  </body>
</html>
