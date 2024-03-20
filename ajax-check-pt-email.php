<?php



	include_once 'include/functions.php';



   	$functions = new Functions();



	$response = 'false';



	if(isset($_POST['personal_email_id']) && !empty($_POST['personal_email_id'])){



		$personal_email_id = $functions->escape_string($functions->strip_all($_POST['personal_email_id']));



		$notallowed=array(



	      'gmail.com', 'yahoo.com', 'yahoo.co.in', 'hotmail.in','hotmail.com', 'rediff.com', 'rediffmail.com', 'GMAIL.COM', 'YAHOO.COM', 'YAHOO.CO.IN', 'HOTMAIL.IN','HOTMAIL.COM', 'REDIFF.COM', 'REDIFFMAIL.COM'



	    );



	    $email_parts = explode( '@', $personal_email_id);



	    $domain = array_pop( $email_parts);



	    if(in_array( $domain, $notallowed)) {



	    	$response="false";



	    }else{



	    	$response="true";



	    }



	}



	echo $response;



?>