<?php

				$txt_search = $_POST['txt_search'];
				echo $txt_search;
	if ($_POST['buy_search']!=""){
		echo $txt_search "will be searched to buy";
		
	}
	else if ($_POST['sell_search']!=""){
		echo $txt_search "will be searched to sell";
	}
	



?>