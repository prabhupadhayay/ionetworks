<?php

	include_once 'include/functions.php';

   	$functions = new Functions();

	if(isset($_POST['fileType']) && !empty($_POST['fileType']) && isset($_POST['productId']) && !empty($_POST['productId']) && isset($_POST['chatSessionId']) && !empty($_POST['chatSessionId'])) {

		$fileType = $functions->escape_string($functions->strip_all($_POST['fileType']));

		$productId = $functions->escape_string($functions->strip_all($_POST['productId']));

		$chatSessionId = $functions->escape_string($functions->strip_all($_POST['chatSessionId']));

		$sql ="select * from ".PREFIX."document_download_request where chatSessionId='".$chatSessionId."' AND product_id='".$productId."' ";

		$query = $functions->query($sql);

		$column = $fileType;


		if($fileType == 'data_sheet'){

			$ftype = "Datasheet";

		}else if($fileType == 'user_start_guide'){

			$ftype = "Quick Start Guide";

		}else if($fileType == 'start_guide'){

			$ftype = "User Manual";

		}else if($fileType == 'brochure'){

			$ftype = "Brochure";

		}else{

			$ftype = "";

		}

		

		if($functions->num_rows($query) > 0){
			$data = $functions->fetch($query);
			$sqlInsert = "INSERT INTO ".PREFIX."resource_download_history(chatSessionId, request_id, product_id, file_type)VALUES('".$chatSessionId."', '".$data['id']."', '".$productId."', '".$ftype."')";
			$functions->query($sqlInsert);
			$sqlProduct = "select * from ".PREFIX."product_master where id='".$productId."' ";
			$queryProduct = $functions->query($sqlProduct);
			$productDetails = $functions->fetch($queryProduct);
			$fileNameManipulate = $productDetails[$column];
			$arr = explode(".", $fileNameManipulate, 2);
			$dynamicstring = $arr[0];
			$ext = $arr[1];
			$newstring = substr($dynamicstring, -14);
			$newstring = str_replace($newstring, '', $dynamicstring);
			$fileName = $newstring.".".$ext;
			include_once("include/emailers/user-downloaded-resources.php");
			include_once("include/classes/Email.class.php");
			$to = "iosales@hfcl.com";
			//$to = "ajay@innovins.com";
			$subject = SITE_NAME." | User Downloaded Resources";
			$emailObj = new Email();
			$emailObj->setSubject($subject);
			$emailObj->setEmailBody($emailMsg);
			$emailObj->setAddress($to);
			$emailObj->sendEmail();
		}

	}

?>