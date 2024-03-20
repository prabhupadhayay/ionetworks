<?php

	include_once 'include/functions.php';

   	$functions = new Functions();



	if(isset($_POST['product_id'])){

		$product_id = $functions->escape_string($functions->strip_all($_POST['product_id']));

		$productDetails = $functions->getUniqueProductById($product_id);



				if(!empty($productDetails['data_sheet'])){

			?>

					<div class="result-sub match">

						<img src="images/resultwifi.png" alt="resultwifi">

						<h4>Datasheet</h4>

						<a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn">Download</a>

					</div>

			<?php } 



				if(!empty($productDetails['user_start_guide'])){

			?>

				<div class="result-sub match">

					<img src="images/resultwifi.png" alt="resultwifi">

					<h4>Quick Start Guide</h4>

					<a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn">Download</a>

				</div>

			<?php } 

				if($productDetails['display_user_manual'] > 0){

			?>

				<div class="result-sub match">

					<img src="images/resultwifi.png" alt="resultwifi">

					<h4>User Manual</h4>

					<a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn">Download</a>

				</div>

			<?php } 

			

				if(!empty($productDetails['brochure'])){

			?>

				<div class="result-sub match">

					<img src="images/resultwifi.png" alt="resultwifi">

					<h4>Brochure</h4>

					<a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn">Download</a>

				</div>

			<?php }



	}

?>