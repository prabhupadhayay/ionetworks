<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';

	$admin = new AdminFunctions();
	if(isset($_POST['category_id'])) {
			$category_id = $admin->escape_string($admin->strip_all($_POST['category_id']));
			$subCategoryDetails = $admin->getAllSubCategoriesByCategoryId($category_id);
			$output = '<option value="">Select</option>';
			if($admin->num_rows($subCategoryDetails) > 0) {
				while($subCategories = $admin->fetch($subCategoryDetails)) {
					$output	.= '<option value="'.$subCategories['id'].'">'.$subCategories['category_name'].'</option>';
				}
			}
	}
	echo $output;
	exit;
?>