<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';

	$admin = new AdminFunctions();
	if(isset($_POST['sub_category_id'])) {
			$sub_category_id = $admin->escape_string($admin->strip_all($_POST['sub_category_id']));
			$varientDetails = $admin->getAllVarientsBySubCategoriesId($sub_category_id);
			$output = '<option value="">Select</option>';
			if($admin->num_rows($varientDetails) > 0) {
				while($varients = $admin->fetch($varientDetails)) {
					$output	.= '<option value="'.$varients['id'].'">'.$varients['name'].'</option>';
				}
			}
	}
	echo $output;
	exit;
?>