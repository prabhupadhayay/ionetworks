<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

   if(isset($_POST['submitContactForm'])){
		$name = $functions->escape_string($functions->strip_all($_POST['name']));
		$lname = $functions->escape_string($functions->strip_all($_POST['lname']));
		$mobile = $functions->escape_string($functions->strip_all($_POST['mobile']));
		$email = $functions->escape_string($functions->strip_all($_POST['email']));
		$country = $functions->escape_string($functions->strip_all($_POST['country']));
		if(isset($_POST['city'])){
			$city = $functions->escape_string($functions->strip_all($_POST['city']));
		}else{
			$city="";
		}
		$enquiry_type = $functions->escape_string($functions->strip_all($_POST['enquiry_type']));
		$message = $functions->escape_string($functions->strip_all($_POST['message']));
		$sqlInsert = "insert into ".PREFIX."contact_us_details(name, lname, mobile, email, country, city, enquiry_type, message)VALUES('".$name."', '".$lname."', '".$mobile."', '".$email."', '".$country."', '".$city."', '".$enquiry_type."', '".$message."')";
		$queryInsert = $functions->query($sqlInsert);
		header("location: ".BASE_URL."/Contact-Us/Thank-You");
		exit();
	}
?>