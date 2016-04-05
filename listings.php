<style>
<?php require("home.css") ?>
</style>
<div id="tabs">
  <fb:tabs>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/index.php" title="Home">Home </fb:tab_item>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/about.php" title="About Us"> About</fb:tab_item>
  </fb:tabs>

</div>
<div id="content">
<h1 style="text-align:center;">Choose the copy you wish to buy by clicking the Buy button. By clicking "Buy" you are agreeing to buy the textbook from the seller at the price the seller is asking for.</h1>
  <p>Please view our disclaimer <a href="http://apps.facebook.com/bookcheetah/about.php"> here</a>
</p>
    <?php
include 'config.php';
include 'opendb.php';

require_once 'appinclude.php';

$ISBN =  $_REQUEST['isbn'];
$nid = $_REQUEST['nid'];

//request copies of the selected textbook that are not reserved (eg. they have not been "bought")
$query = "SELECT * FROM booksforsale WHERE ISBN = '$ISBN' AND reserved = 0 AND nid = '$nid'";
$result = mysql_query($query)
or die(mysql_error());

echo "<table id='searchresults'>
	<tr>
        <th>Image</th>
        <th>Price</th>
        <th>Condition</th>
        <th>Seller's Email</th>
        <th>Course Used In</th>
	<th>Professor</th>
        <th>Buy it!</th>
	</tr>
        ";

while($row = mysql_fetch_array($result)){
	?>
		<tr>
			<td>
        			<?php echo '<img src="' . $row['bookimg'] . '" border="0" alt="Image 				unavailable." />';?>
      			</td>
			<td>
				<?php echo '<p>$' . $row['price']. '</p>';?>
			</td>
			<td>
				<?php
				//Display the condition in a pleaseing manner
				switch ($row['condition']) {
				case 'new':
					echo '<p>New</p>';
					break;
				case 'like_new':
					echo '<p>Like New</p>';
					break;
				case 'very_good':
					echo '<p>Very Good</p>';
					break;
				case 'good':
					echo '<p>Good</p>';
					break;
				case 'fair':
					echo '<p>Fair</p>';
					break;
					}
				?>
			</td>
			<td><?php echo '<p>'. $row['semail'] . '</p>';?></td>
            		<td><?php echo '<p>'. $row['course']. '</p>';?></td>
			<td><?php echo '<p>'. $row['teacher']. '</p>';?></td>
			<td><a href="http://apps.facebook.com/bookcheetah/buyercontact.php?postid=<?php echo $row['postid'];?>"><p>Buy</p></a></td>
		</tr>
	<?php

};
echo "</table>";

include 'closedb.php';
?>

  </div>
</div>