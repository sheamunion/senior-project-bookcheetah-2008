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
  <h1 style="text-align:center; font-size:20px; font-weight:bold;">Choose the textbook you want to buy.</h1>
<?php
require_once 'appinclude.php';
include 'config.php';
include 'opendb.php';

//Get user's search term
    $searchvalue = $_POST['txt_buy'];

//Get the user's network id and name
    $uid = $user;
    $info = $facebook->api_client->users_getInfo($uid, 'affiliations');
    $affiliations = $info[0]['affiliations'][0];
    $nid = $affiliations['nid'];
    $nname = $affiliations['name'];

//configure the soap request to AWS
    $client = new SoapClient("http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl");
    $params = array(
	'Service'	 	 => 'AWSECommerceService',
	'AWSAccessKeyId' => $AWSAccessKeyId,
	'Operation' 	 => 'ItemSearch',
	'Request' => array(
					'SearchIndex'    => 'Books',
					'Keywords'       => "'".$searchvalue."'",
					'ResponseGroup'	 => 'Medium',
					'AssociateTag'   => 'booksc-20'
					)
      );

//Issue the request and store the response
    $response = $client->ItemSearch($params);

echo "<table  id='searchresults'>";

//Parse the SOAP resposne using Foreach loop
    foreach ($response->Items->Item AS $product)
    {
    if(is_array($product->ItemAttributes->Author)) {
				$author = implode(", ", $product->ItemAttributes->Author);
				}
			else  {
				$author =  $product->ItemAttributes->Author;
				};
?>
 <tr>
        <td>
          <?php echo '<img src="' . $product->SmallImage->URL . '" border="0" alt="Image unavilable.">'; ?>
        </td>
		<td colspan="2">
          <p style="font-weight:bold;" >
            <?php echo $product->ItemAttributes->Title; ?>
          </p>
          <p>
            <?php echo $author; ?>
          </p>
        </td>
        <td>
          <p>
            <?php echo $product->ItemAttributes->ISBN;
                $ISBN = $product->ItemAttributes->ISBN;
            ?>
          </p>
        </td>
	 	<td>
					<?php
				  //Find avaialbe copies in BCDB using current Amazon ISBN
				  $bcresult = mysql_query("SELECT isbn FROM booksforsale WHERE isbn = '$ISBN' AND reserved = 0 AND nid = '$nid'");
				  $bcarray = mysql_fetch_array($bcresult);
					 //If there are no available copies (array is empty) display link to amazon.
							if (empty($bcarray)) {
								echo '<a href="' . $product->DetailPageURL . '" title="Click here to buy from Amazon">Buy from Amazon! ' . $product->ItemAttributes->ListPrice->FormattedPrice . '</a>';
								}
					 //Else there are available copies (array is not empty) count available copies and print a link to the listed copies.
							else {
					?>
							  <a style="text-align:center; font-weight:bold; font-size:16px;" id="view_copies" href="http://apps.facebook.com/bookcheetah/listings.php?nid=<?php echo $nid; ?>&isbn=<?php echo $ISBN;?>" title="Click here to view copies listed by students at your campus">Buy copies at <?php echo $nname; ?>.</a>
					<?php
					mysql_free_result($bcresult);
			};

					?>
        </td>
	</tr>
<?php
};
echo '</table>';

include 'closedb.php';

// Example SOAP response
//http://ecs.amazonaws.com/onca/xml?Service=AWSECommerceService&SearchIndex=Books&Keywords=History&Operation=ItemSearch&ResponseGroup=Medium&AWSAccessKeyId=***I removed my key for privacy***
?>
</table>
</div>
