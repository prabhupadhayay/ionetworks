<?php
	include_once 'include/functions.php';
   	$functions = new Functions();
	if(isset($_POST['category_id'])) {
			$category_id = $functions->escape_string($functions->strip_all($_POST['category_id']));
			$subCategoryDetails = $functions->getAllSubCategoriesByCategoryId($category_id);
			$output = '<option selected disabled focus>Select Product sub category</option>';
			if($functions->num_rows($subCategoryDetails) > 0) {
				while($subCategories = $functions->fetch($subCategoryDetails)) {
					$output	.= '<option value="'.$subCategories['id'].'">'.$subCategories['category_name'].'</option>';
				}
			}
	}
	echo $output;
	exit;
?>