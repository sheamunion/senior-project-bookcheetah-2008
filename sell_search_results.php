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

  <h1 style="text-align:center; font-size:20px; font-weight:bold;">Choose the textbook you want to sell.</h1>

    <?php
require_once 'appinclude.php';

include 'config.php';
include 'opendb.php';

$searchvalue = $_POST['txt_sell'];

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

//Parse the SOAP resposne using foreach loop
    foreach ($response->Items->Item AS $product)
    {
    if(is_array($product->ItemAttributes->Author)) {
				$author = implode(", ", $product->ItemAttributes->Author);
				}
			else  {
				$author =  $product->ItemAttributes->Author;
				};

    $lownewprice = $product->OfferSummary->LowestNewPrice->FormattedPrice;
    $lowusedprice = $product->OfferSummary->LowestUsedPrice->FormattedPrice;
    $listprice = $product->ItemAttributes->ListPrice->FormattedPrice;
?>
      <tr>
          <td>
            <?php echo '<img src="' . $product->SmallImage->URL.'" border="0" alt="Image unavailable">'; ?>
          </td>
        <td colspan="2">
          <p style="font-weight:bold;">
            <?php echo $product->ItemAttributes->Title; ?>
          </p>
          <p>
            <?php echo $author; ?>
          </p>
        </td>
        <td>
          <p>
            <?php echo $product->ItemAttributes->ISBN; ?>

          </p>
        </td>
        <td>
            <a href="http://apps.facebook.com/bookcheetah/sellercontact.php?imgsm=<?php echo $product->SmallImage->URL;?>&imgmd=<?php echo $product->MediumImage->URL;?>&title=<?php echo $product->ItemAttributes->Title;?>&author=<?php echo $author;?>&ISBN=<?php echo $product->ItemAttributes->ISBN;?>&listprice=<?php echo $listprice;?>&lownewprice=<?php echo $lownewprice;?>&lowusedprice=<?php echo $lowusedprice;?>">
			      <img src="http://bookcheetah.com/img/btnsellnow.png" alt="Sell this book." />
			      </a>
        </td>
        </tr>
<?php
};
include 'closedb.php';
?>
    </table>
  </div>
