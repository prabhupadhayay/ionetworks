<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$response = 'false';

	$id = "";
	if(isset($_POST['permalink']) && !empty($_POST['permalink'])){
		$permalink = trim($admin->escape_string($admin->strip_all($_POST['permalink'])));
		//$permalink = $admin->getValidatedPermalink($category_name);
		
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $admin->escape_string($admin->strip_all($_POST['id']));
			$id = " and id<>'".$id."'";
		}
		
		$checkUserExistSQL = $admin->query("select * from ".PREFIX."category_master where permalink='".$permalink."' $id");

		if($admin->num_rows($checkUserExistSQL)>0){
			$response="false";
		} else{
			$response="true";
		}
	}
	echo $response;
?>