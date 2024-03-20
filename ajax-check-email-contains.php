<?php

	include_once 'include/functions.php';

   	$functions = new Functions();

	$response = 'false';

	if(isset($_POST['email']) && !empty($_POST['email'])){

		$email = $functions->escape_string($functions->strip_all($_POST['email']));

		$notallowed=array(

	      'gmail.com', 'yahoo.com', 'yahoo.co.in', 'hotmail.in','hotmail.com', 'rediff.com', 'rediffmail.com', 'GMAIL.COM', 'YAHOO.COM', 'YAHOO.CO.IN', 'HOTMAIL.IN','HOTMAIL.COM', 'REDIFF.COM', 'REDIFFMAIL.COM','meraki.com' ,'cambiumnetworks.com','netgear.com','indionetworks.com','plume.com'

	    );

	    $email_parts = explode( '@', $email);

	    $domain = array_pop( $email_parts);

	    if(in_array( $domain, $notallowed)) {

	    	$response="false";

	    }else{

	    	$response="true";

	    }

	}

	echo $response;

?>