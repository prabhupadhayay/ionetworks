<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(isset($_POST['sub_category_id']) && !empty($_POST['sub_category_id'])) {
		$sub_category_id = $admin->escape_string($admin->strip_all($_POST['sub_category_id']));
		$subCategorySQL = $admin->getAllVarientBySubCategoryId($sub_category_id);
		$selectContent = '<option value="">Select Verient</option>';
		while($subCategory = $admin->fetch($subCategorySQL)) {
			$selectContent .= '<option value="'.$subCategory['id'].'">'.$subCategory['name'].'</option>';
		}

		$ajaxResponse = array();
		$ajaxResponse['status'] = 1;
		$ajaxResponse['selectContent'] = $selectContent;
		echo json_encode($ajaxResponse);
	} else {
		$selectContent = '<option value="">Select Verient</option>';
		$ajaxResponse = array();
		$ajaxResponse['status'] = 1;
		$ajaxResponse['selectContent'] = $selectContent;
		echo json_encode($ajaxResponse);
	}
?>