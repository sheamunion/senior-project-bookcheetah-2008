<style>
  <?php require("home.css") ?>
</style>
<div id="tabs">
  <fb:tabs>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/index.php" title="Home">Home </fb:tab_item>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/about.php" title="About Us"> About</fb:tab_item>
  </fb:tabs>
</div>
<?php 
  require("appinclude.php");
  
  include 'config.php';
  include 'opendb.php';

// Get values from sellercontact form and store in variables
    $bookimg = $_POST['bookimg'];
    $ISBN = $_POST['ISBN'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];
    $condition = $_POST['condition']; 
    $course =  $_POST['course'];
    $teacher = $_POST['teacher'];
    $semail = $_POST['semail'];
    $sphone = $_POST['sphone'];
    $userid = $user;
    $dbname = 'booksforsale';
    
//Get the user's network id. The nid will be used in buy_search_results.php to only display books that are listed in the buyers network. 
    $uid = $user;
    $info = $facebook->api_client->users_getInfo($uid, 'affiliations');
    $affiliations = $info[0]['affiliations'][0];
    $nid = $affiliations['nid'];

//Give the listed copy a reserved value of false or NULL. This means the copy is available to buyers.
    $reserved = '0';

//Open DB connection
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    mysql_select_db($dbname);

// Insert the seller's copy into the database
    $query = "insert into booksforsale (bookimg, title, author, edition, userid, teacher, course, ISBN, `condition`, price, reserved, semail, sphone, nid) values ('$bookimg', '".mysql_real_escape_string($title)."', '".mysql_real_escape_string($author)."', '$edition', '$userid', '".mysql_real_escape_string($teacher)."', '$course', '$ISBN', '$condition', '$price', '$reserved', '$semail', '$sphone', '$nid')";
    mysql_query($query) or die(mysql_error());

    include 'closedb.php';

?>

<div id="content">
  <div id="searchresults">
    <h2 style="text-align: center; font-size:26px;"> 
		Great! Your book has been listed. We'll send you an email when a buyer is interested.

    </h2>
    <br />    
	<a style="text-align: center; font-size:26px;" href="http://apps.facebook.com/bookcheetah" alt="BookCheetah home">Return to the BOOKCHEETAH home page.</a>
  </div>
</div>
