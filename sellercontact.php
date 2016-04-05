<?php 
  require("appinclude.php");
 
//===grab the textbook information from the query string
  $title = $_REQUEST['title'];
  $author = $_REQUEST['author'];
  $ISBN = $_REQUEST['ISBN'];
  $imgsm = $_REQUEST['imgsm'];
  $imgmd = $_REQUEST['imgmd'];
  $listprice = $_REQUEST['listprice'];
  $lownewprice = $_REQUEST['lownewprice'];
  $lowusedprice =  $_REQUEST['lowusedprice'];
?>
<style>
  <?php require("home.css") ?>
</style>
<script>
  function ch()
   {
      if(document.getElementById("semail").getValue() == "")
      {
        document.getElementById("result_ch").setTextValue('Enter your email');
        return false;
      }
      else{
       return true;
      }
      }
</script>
<div id="tabs">
  <fb:tabs>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/index.php" title="Home">Home </fb:tab_item>
    <fb:tab_item href="http://apps.facebook.com/bookcheetah/about.php" title="About Us"> About</fb:tab_item>
  </fb:tabs>

</div>
<div id="content">

    <br />
    <br />
      <h1 style="text-align: center; font-family:Arial, Helvetica, sans-serif; font-size:16px; border:10px;">
        Please confirm the following textbook information, provide the condition of the book and the price you're selling it for.
      </h1>
    <br />

    <!--      If user chooses "Book You've bought using BookCheetah" combo box, get the variable "purchasedbook" which contains the textbook's ISBN (from the combo box), 
    then get the information about that textbook from the DB, and fill in as much of the form as possible. 
    Also, display "You paid PRICE for this textbook" where PRICE=the amount they paid for the textbook.-->

    <!--      Begin the seller contact/list book form.
    The Title, Author, and ISBN will be filled in for the user using PHP.
    -->
    <form method="post" action="http://apps.facebook.com/bookcheetah/seller_confirm.php"
      <table id="contact">
        <tr>
          <td style="text-align:right;" rowspan="9" valign="top">
            <?php echo '<input name="bookimg" type="hidden" value="' . $imgsm . '" /> <img src="' . $imgmd . '" alt="Image unavailable." border="0"/>'; ?>
          </td>

          <tr>
            <td>
                <p class="right">ISBN:</p>
          </td>
          <td>
                    <?php echo '<input type="text" name="ISBN" size="30" readonly="readonly" value="';
                        echo $ISBN;
                        echo '"/>';
                  ?>
          </td>
        </tr>
      </tr>
      <tr>
        <td style="text-align:right;">
          <p class="right">Title:</p>
        </td>
        <td>
          <?php echo '<input type="text" name="title" size="30" maxlength="200" readonly="readonly" value="';
                echo $title;
                echo '"/>';
          ?>
          <!--<input type="text" name="title" size="30" value="<?php echo $title;?>" />-->
        </td>
      </tr>
      <tr>
        <td>
          <p class="right">Author:</p>
        </td>
        <td>
          <?php echo '<input type="text" name="author" size="30" readonly="readonly" value="';
                echo $author;
                echo '"/>';
          ?>
          </td>
        </tr>
        <tr>
          <td>
            <p class="right">Edition:</p>
          </td>
          <td>
            <p class="example_input">
              <input type="text" name="edition" maxlength="2" size="1" /> ex: 3
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="right">
                Price (USD):
            </p>
          </td>
          <td>
            <p class="example_input">
              <input type="text" name="price" maxlength="6" size="3" /> ex: 15.00
            </p>
           <a href="#" alt="Price:" onclick="var dialog = new Dialog().showChoice('Suggested Listing Price', dialog_price, 'Close'); return false;">
            <p>Suggested Lising Prices</p>
              </a>
            <fb:js-string var="dialog_price">
              <div>
                <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Listed price for new copy at Amazon: <b><?php echo $listprice; ?></b></p>
                   <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Lowest priced new copy at Amazon: <b><?php echo $lownewprice; ?></b></p>
                <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Lowest priced used copy at Amazon: <b><?php echo $lowusedprice; ?>
                  </b>
                </p>
                </div>
            </fb:js-string>
          </td>
        </tr>
        <tr>
          <td style="vertical-align:top;">
            <p class="right">
                Condition:
            </p>
          </td>
			
          </td>
          <td>
            <select name="condition">
              <option value="new">New</option>
              <option value="like_new">Like New</option>
              <option value="very_good">Very Good</option>
              <option value="good">Good</option>
              <option value="fair">Acceptable</option>
            </select>
            			<a href="#" alt="Book Condition" onclick="var dialog = new Dialog().showChoice('Condition descriptions', dialog_condition, 'Close'); return false;">
        <p>Condition Descriptions</p>
        </a>
        <fb:js-string var="dialog_condition">
				<div>
					<p style="font-weight:bold;">New: </p><p>A brand-new, unused, unread copy in perfect condition. </p>
					<p style="font-weight:bold;">Like New: </p><p>An apparently unread copy in perfect condition. Dust cover is intact; pages are clean and are not marred by notes or folds of any kind. Suitable for presenting as a gift. </p>
					<p style="font-weight:bold;">Very Good: </p><p>A copy that has been read, but remains in excellent condition. Pages are intact and are not marred by notes or highlighting. The spine remains undamaged. </p>
					<p style="font-weight:bold;">Good: </p><p>A copy that has been read, but remains in clean condition. All pages are intact, and the cover is intact (including dust cover, if applicable). The spine may show signs of wear. Pages can include limited notes and highlighting. </p>
					<p style="font-weight:bold;">Acceptable: </p><p>A readable copy. All pages are intact, and the cover is intact (the dust cover may be missing). Pages can include considerable notes--in pen or highlighter--but the notes cannot obscure the text. </p>
				</div>
			</fb:js-string>
          </td>
        </tr>
        <tr>
          <td>
            <!-- Link or ToolTip will instruct user to input the course they used this textbook in-->
            <p class="right">Course used in:</p>
          </td>
          <td>
            <p class="example_input">
              <input type="text" name="course" size="10" maxlength="10" /> ex: ISAT 493
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="right">Teacher:</p>
          </td>
          <td>
            <p class="example_input">
              <input type="text" name="teacher" size="15" /> ex: John Smith
            </p>
          </td>
        </tr>
        <!--<tr>
			<td colspan="3">
				<p style="color:red;">Please provide your email so we can notify you when a buyer is interested. Your email will not be shared.</p>
			</td>
        </tr>-->
        <tr>
          <td>
          </td>
			<td>
				<p class="right">Email:</p>
			</td>
			<td>
				<p class="example_input">
					<input type="text" name="semail" size="20" /> ex: cheetabc@jmu.com
				</p>
			</td>
			<td>
			<div id="result_ch"></div>
			</td>
        </tr>
       <!--<tr>
			<td colspan="3">
				<p style="color:red;">Providing your phone number to the buyer simplifies the process of setting up a date, time, and location to complete your transaction.</p>
			</td>
        </tr>-->
        <tr>
          <td>
          </td>
          <td>
            <p class="right">Phone #:</p>
          </td>
          <td>
            <p class="example_input">
              <input type="text" name="sphone" maxlength="10" size="10"/> ex: 1234567890
              <input type="hidden" name="process" value="1" />
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <br />
          </td>
          <td>
            <br />
          </td>
          <td>
            <input type="image" src="http://books.chiang-home.com/sheasandbox/facebook/img/btnsell.png" onclick="return ch();"/>
          </td>
        </tr>
      </table>
    </form>
    


	
  

