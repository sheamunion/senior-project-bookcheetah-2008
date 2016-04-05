<?php 

include 'config.php';
include 'opendb.php';
 ?>
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
		<h1 style="text-align: center; font-family:Arial, Helvetica, sans-serif; font-size:16px; border:10px;">
			The textbook has been reserved for you. Please confirm or provide your email for the seller. If you'd like, you can provide 
			your phone number to the seller to help coordinate a date, time, and location for completing your transaction.
		</h1>
    <br />
<?php 
$postid = $_REQUEST['postid'];

//Assign the "purchased" copy a reserved value of true or 1
$updatequery = mysql_query("UPDATE booksforsale SET reserved = '1' WHERE postid = '$postid'")
or die(mysql_error());

include 'closedb.php';
?>
    <form method="post" action="http://apps.facebook.com/bookcheetah/buyerconfirm.php">
      <table class="center">
        <tr>
          <td>
            <p>email:</p>
          </td>
          <td>
			<p class="example_input">
					<input type="text" name="bemail" size="30" /> ex: cheetabc@jmu.edu
                    <input type="hidden" name="postid" value="<?php echo $postid; ?>" />
			</p> 
          </td>
        </tr>
        <tr>
          <td>
            <p>
              Phone #:
            </p>
          </td>
          <td>
			<p class="example_input">
				<input type="text" name="bphone" size="30" />  ex: 1234567890
            </p>
          </td>
        </tr>
		<tr>
          <td>
           <br />
          </td>
          <td>
      <input type="submit" name="btn_buyer_contact" value="Submit contact info" />
          </td>
        </tr>
      </table>
    </form>
  </div>

