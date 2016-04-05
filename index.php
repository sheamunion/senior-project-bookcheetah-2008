<?php //Include facebook library
require_once 'appinclude.php';
?>
  <style>
<?php require("home.css") ?>
  </style>
<fb:header decoration="add_border" />
<script type="text/javascript" language="javascript">
function displayError(title, message, context) { 
new Dialog(Dialog.DIALOG_CONTEXTUAL).setContext(context).showChoice(title, message, 'Ok', ''); 
}
function checkTextBox(txt_Buy) { 
if (checkValidity(txt_Buy.getValue())) (
displayError("Error title", "Error message", txt_Buy); 
)
}
function checkValidity(value) {
empty(value);
}
</script>
<div id="tabs"> 
  <fb:tabs> 
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/index.php" title="Home">Home </fb:tab_item>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/about.php" title="About Us"> About</fb:tab_item>
  </fb:tabs>
</div>

<div id="topsection"> 
<!-- HOW IT WORKS BUTTON
<a
href="#" id="dialog_body"
onclick="var dialog = new Dialog().showChoice('How BookCheetah Works', dialog_welcome, 'Okay'); return false;">
<img
src="http://bookcheetah.com/facebook/img/btnhowitworks.png">
</a><br>
<fb:js-string var="dialog_welcome"> 
<div>
<p style="font-family: Arial,Helvetica,sans-serif; font-size: 16px;">Welcome
to BookCheetah! Use this service to sell and buy used textbooks at your
school. If you want to buy a used book, search for it using the 'Buy'
panel. If someone at your school is selling that textbook you can
reserve it. The seller will be notified and will contact you. It is
then up to you and the seller to determine a location, time, and date
to meet to complete the transaction. If no one is selling that textbook
at your school, you can buy it directly from Amazon.com!<br>
<br>
If you have a book to sell, simply search for it using the 'Sell'
panel. Select the book you wish to sell fill out the form. Your book is
listed immediately to Facebook users within your network. <br>
<br>
We've tried to make this process as simple as possible for your
convenience. Thanks for using BookCheetah!<br>
</p>
</div>
</fb:js-string>
-->
<!-- BookCheetah Logo -->

<div id="logo">
<img src="http://bookcheetah.com/facebook/img/bc5.png" alt="BookCheetah" />
</div>

  <?php 
//======Random slogan selector=======
	$rnd = rand(1,5);
	$slo1 = "Buy and Sell used textbooks with ease!";
  $slo2 = "Don't get cheated by bookstore prices!";
  $slo3 = "Read between the spots.";
  $slo4 = "It's fast. Like a cheetah.";
  $slo5 = "More options than a cheetah has spots. Almost.";
  
				//Display a random slogan
				switch ($rnd) {
				case 1:
					echo '<p style="text-align:center; font-size:20px; color:#000;">'.$slo1.'</p>';
					break;
				case 2:
					echo '<p style="text-align:center; font-size:20px; color:#000;">'.$slo2.'</p>';
					break;
				case 3:
					echo '<p style="text-align:center; font-size:20px; color:#000;">'.$slo3.'</p>';
					break;
				case 4:
					echo '<p style="text-align:center; font-size:20px; color:#000;">'.$slo4.'</p>';
					break;
       	case 5:
					echo '<p style="text-align:center; font-size:20px; color:#000;">'.$slo5.'</p>';
					break;   
					}
  ?>
<a href="#" id="dialog_body" onclick="var dialog = new Dialog().showChoice('Suggest a slogan!', dialog_slogansuggest, 'Send it'); return false;">
Suggest a slogan!
</a> 
<fb:js-string var="dialog_slogansuggest">
  <style>
    .slop {
    font-size: 20px; 
    font-family: sans-serif; 
    }
    .slobox {
    height:20px;
    font-size:16px;
    font-weight:bold;
    font-family: sans-serif;
    }
  </style>
<p class="slop">
Do you have a slogan we should use? We don't care if it's witty, silly, direct or way out there--we want to hear it! Just type your slogan in the box below and click 'Send it'! 
</p>
 <input class="slobox" type="text" name="suggestedslo" size="40"/>
<p class="slop">
If we do use your slogan, we can let everyone know that you came up with it. Just check the box below and fill out your name. This, of course, is optional.
</p>
 
</fb:js-string>

<!--
<h3 style="font-family:arial; font-size:16px;"> Hi <fb:name uid=<?php echo $user; ?> firstnameonly="true" useyou="false"/>. From here you can easily find the texbooks you want to Buy or Sell. </h3>
<h2>Your network id is
<?php $uid = $user;
$info = $facebook->api_client->users_getInfo($uid, 'affiliations');
$affiliations = $info[0]['affiliations'][0];
echo $affiliations['nid'];
?> and your network name is <?php echo $affiliations['name'];?>.
</h2>
-->



<div id="searchbuy">
<form method="post" action="http://apps.facebook.com/bookcheetah/buy_search_results.php">
  <table class="center">
    <tbody>
      <tr>
        <td class="center"> <input class="query" name="txt_buy" size="25" type="text" onblur="return checkTextBox(this);" /> </td>
      </tr>
      <tr>
        <td class="center"> <input src="http://bookcheetah.com/facebook/img/btnbuy.png" alt="Click here to buy your textbook" type="image" /> <a href="#" id="dialog_body" onclick="var dialog = new Dialog().showChoice('Search help', dialog_searchhelp, 'Okay'); return false;">
        <img src="http://bookcheetah.com/facebook/img/btnhelp.png" alt="Search by ISBN, Title, Author" /> </a> <fb:js-string var="dialog_searchhelp">
        <p style="font-size: 20px; font-family: Arial,Helvetica,sans-serif; font-weight: bold;">Search
by ISBN (no dashes), Title, or Author</p>
 </fb:js-string>
        </td>
      </tr>
    </tbody>
  </table>
</form>
</div>
<div id="searchsell">
<form method="post" action="http://apps.facebook.com/bookcheetah/sell_search_results.php">
  <table class="center">
    <tbody>
      <tr>
        <td class="center"> <input class="query" name="txt_sell" maxlength="100" type="text"> </td>
      </tr>
      <tr>
        <td class="center"> <input src="http://bookcheetah.com/facebook/img/btnsell.png" alt="Click here to sell your textbook" type="image" /> <a href="#" id="dialog_body" onclick="var dialog = new Dialog().showChoice('Search help', dialog_searchhelp, 'Okay'); return false;">
        <img src="http://bookcheetah.com/facebook/img/btnhelp.png" alt="Search by ISBN, Title, Author" /> </a> <fb:js-string var="dialog_searchhelp"> <p style="font-size: 20px; font-family: Arial,Helvetica,sans-serif;">Search
by ISBN (no dashes), Title, or Author</p>
        </fb:js-string> </td>
      </tr>
    </tbody>
  </table>
</form>
</div>
</div>

