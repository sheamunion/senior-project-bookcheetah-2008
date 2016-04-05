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
  include 'config.php';
  include 'opendb.php';
  require_once 'appinclude.php';
  require_once 'client/facebookapi_php5_restlib.php';

//===Get values from sellercontact form and store in variables===
  $bemail = $_POST['bemail'];
  $bphone = $_POST['bphone'];
  $postid = $_POST['postid'];

//===Open DB connection===
  $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
  mysql_select_db($dbname);

//===Create query to insert buyer's information into the buyercontact table===
  $query = "insert into buyercontact (bemail, bphone) values ('$bemail', '$bphone')";

//===Execute query===
  mysql_query($query) or die(mysql_error());

//===Get the seller's userid to use in email content variable fbml
  $bcresult = mysql_query("SELECT * FROM booksforsale WHERE postid = '$postid'") or die(mysql_error());

  while ($row = mysql_fetch_array($bcresult, MYSQL_ASSOC)) {
      $recipients = $row['semail'];
      $title = $row['title'];
      $price = $row['price'];
  }


$message = '<p>Hello!</p><p> Someone is interested in buying the following textbook from you.</p>\n'.$title.'\n'.$price;


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: BOOKCHEETAH' . "\r\n";

mail($recipients, 'Someone wants to buy your textbook!', $message, $headers);

?>

<div id="content">
  <div id="searchresults">
    <h1 style="text-align:center; font-size:20px; font-weight:bold;">
		Great! The seller has been notified by email and will be in contact with you to complete your transaction.
    <br />
<br />
<a href="http://apps.facebook.com/bookcheetah/" alt="BookCheetah home">Return to the BOOKCHEETAH home page.</a>
    </h1>

  </div>
</div>
<?php
include 'closedb.php';
?>
<!--
/**
//===Set sendEmail parameters===
  $subject = 'Someone wants to buy your book';
  $text = '';
//===This email content works
  $fbml = '<p>Hello Shea,</p><p>Lewis Muller wants to buy your textbook listed on <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a> You can contact the interested party to determine a location, date, and time to meet at mullerjl@jmu.edu.</p><p>Please be aware when choosing a place and time to meet to complete transactions. Public locations on campus during busy hours are preferable for your safety.</p> <p>Thanks for using <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a></p>';

//===Call and send the email
  $facebook->api_client->notifications_sendEmail($recipients, $subject, $text, $fbml);





//===Trying to get these values to make content of email meaningful.===
    $userInfo = $facebook->api_client->users_getInfo($user, array("first_name", "last_name"));

//===Ideal email content===
    $fbml = '<p>Hello <fb:name uid="' . $recipients . '" />,</p><p>Someone wants to buy your copy of ' . $title . ' listed for $' . $price . 'on <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a> The only thing left to do is for you to contact the interested party to determine a location, date, and time to meet. You can contact the interested party at ' . $bemail . ' or ' . $bphone . '. </p> <p>Thanks for using <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a></p>';

    $fbml = '<p>Hello ' . $userInfo[0]['first_name'] . ',</p><p>Someone wants to buy your copy of ' . $title . ' listed for $' . $price . 'on <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a> The only thing left to do is for you to contact the interested party to determine a location, date, and time to meet. You can contact the interested party at ' . $bemail . ' or ' . $bphone . '. </p> <p>Thanks for using <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a></p>';

//This email content works but sends no buyer information to the seller!
  $fbml = '<p>Hello,</p><p>Someone wants to buy your textbook listed on <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a> The only thing left to do is for you to contact the interested party to determine a location, date, and time to meet. You can contact the interested party.</p> <p>Thanks for using <a href="http://apps.facebook.com/bookcheetah/">BookCheetah!</a></p><p>The BookCheetah Team</p>';

//===Trying to get notifications (to facebook acct) to work.===
  $notification = 'Someone wants to buy your book!';
  $to_ids = $recipients;
  $facebook->api_client->notifications_send($to_ids, $notification);

//===Content for a facebook message... if we get that link to work.
  $msg = 'Hi! I found your book listed for sale on BookCheetah. I'd like to buy it from you. Let's arrange a time and location to complete the trade.';
//===Link to send a facebook message. Trying to populate it with the seller's uid, a subject, and a message

*/
-->





<!--
  /**
   * Sends a notification to the specified users.
   * @return (nothing)
   */
  public function &notifications_send($to_ids, $notification) {
    return $this->call_method('facebook.notifications.send',
                              array('to_ids' => $to_ids, 'notification' => $notification));
  }

  /**
   * Sends an email to the specified user of the application.
   * @param array $recipients : id of the recipients
   * @param string $subject : subject of the email
   * @param string $text : (plain text) body of the email
   * @param string $fbml : fbml markup if you want an html version of the email
   * @return comma separated list of successful recipients
   */
  public function &notifications_sendEmail($recipients, $subject, $text, $fbml) {
    return $this->call_method('facebook.notifications.sendEmail',
                              array('recipients' => $recipients,
                                    'subject' => $subject,
                                    'text' => $text,
                                    'fbml' => $fbml));
-->
