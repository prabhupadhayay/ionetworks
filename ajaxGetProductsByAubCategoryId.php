<?php
	include_once 'include/functions.php';
   	$functions = new Functions();
	if(isset($_POST['sub_category_id'])) {
			$sub_category_id = $functions->escape_string($functions->strip_all($_POST['sub_category_id']));
			$productDetails = $functions->getAllProductsBySubCategoryId($sub_category_id);
			$output = '<option selected disabled focus>Select Product</option>';
			if($functions->num_rows($productDetails) > 0) {
				while($productData = $functions->fetch($productDetails)) {
					$output	.= '<option value="'.$productData['id'].'">'.$productData['product_name'].'</option>';
				}
			}
	}
	echo $output;
	exit;
?>