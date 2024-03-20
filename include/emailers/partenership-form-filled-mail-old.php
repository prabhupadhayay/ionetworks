<?php
	ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Partnership Form Filled</title>
    <style>


		 @import url(https://fonts.googleapis.com/css?family=Roboto:300); /*Calling our web font*/

		/* Some resets and issue fixes */
        #outlook a { padding:0; }
		body{ width:100% !important; -webkit-text; size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; }     
        .ReadMsgBody { width: 100%; }
        .ExternalClass {width:100%;} 
        .backgroundTable {margin:0 auto; padding:0; width:100%;!important;} 
        table td {border-collapse: collapse;}
        .ExternalClass * {line-height: 115%;}	
        
        /* End reset */
		
		
		/* These are our tablet/medium screen media queries */
        @media screen and (max-width: 630px){
                
				
			/* Display block allows us to stack elements */                      
            *[class="mobile-column"] {display: block;} 
			
			/* Some more stacking elements */
            *[class="mob-column"] {float: none !important;width: 100% !important;}     
			     
			/* Hide stuff */
            *[class="hide"] {display:none !important;}          
            
			/* This sets elements to 100% width and fixes the height issues too, a god send */
			*[class="100p"] {width:100% !important; height:auto !important;}			        
				
			/* For the 2x2 stack */			
			*[class="condensed"] {padding-bottom:40px !important; display: block;}
			
			/* Centers content on mobile */
			*[class="center"] {text-align:center !important; width:100% !important; height:auto !important;}            
			
			/* 100percent width section with 20px padding */
			*[class="100pad"] {width:100% !important; padding:20px;} 
			
			/* 100percent width section with 20px padding left & right */
			*[class="100padleftright"] {width:100% !important; padding:0 20px 0 20px;} 
			
			/* 100percent width section with 20px padding top & bottom */
			*[class="100padtopbottom"] {width:100% !important; padding:20px 0px 20px 0px;} 
			
		
        }
			
        
    </style>
</head>
<body style="padding:0; margin:0; background:#687079" bgcolor="#687079">
<table border="0" cellpadding="0" cellspacing="0" style="margin: 0; padding: 0" width="100%">
    <tr>
        <td align="center" valign="top">
            <table width="640" border="0" cellspacing="0" cellpadding="0" class="hide">
                <tr>
                    <td height="20"></td>
                </tr>
            </table>
            <table width="640" cellspacing="0" border="0" cellpadding="21" bgcolor="#fff" class="100p" style="border-bottom:solid 1px #ddd;">
                <tr>
                    <td background="#fff" bgcolor="#fff" width="640" valign="top" class="100p">
						<div>
							<table width="640" border="0" cellspacing="0" cellpadding="20" class="100p">
								<tr>
									<td valign="top">
										<table border="0" cellspacing="0" cellpadding="0" width="600" class="100p">
											<tr>
												<td align="center" width="100%" class="100p">
													<a href="<?php echo BASE_URL; ?>" target="_blank" >
														<img  src="<?php echo LOGO; ?>" alt="<?php echo SITE_NAME; ?>" width="200" border="0" style="display:block" /></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
                    </td>
                </tr>
            </table>


            <table width="640" border="0" cellspacing="0" cellpadding="20" bgcolor="#ffffff" class="100p">
            	<tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="padding: 10px 0 10px 0;font-weight:bold; font-size: 30px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #ffffff;" class="padding-copy">Welcome To <?php echo SITE_NAME; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:16px; color:#444;">
						<font face="'Roboto', Arial, sans-serif">
						<p>Dear <?php echo $personal_first_name." ".$personal_last_name; ?>,</p>
						<p>Thank you for your interest in partnering with us.</p>
						<p>Your request will be verified by the designated authorities and notify you soon.</p>
						<p>We look forward to a successful partnership ahead.</p>
						<p>Below is your details, Submited succesfuly.</p>

						<div style="border-top:solid 1px #ddd;">
							<div style="width:640px; margin:10px 0 0 0; float:left;">
								<table width="640" border="0" cellspacing="0" cellpadding="0" style="margin: 20px 0 0 0; font-size:12px;">
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">First Name</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $personal_first_name; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Last Name</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $personal_last_name; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Personal Mobile</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $personal_mobile_no; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Personal Email</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $personal_email_id; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Designation</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $personal_designation; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Email</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $email; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Company Name</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $company_name; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Primary Virtual Market</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $primary_market; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Primary Business</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $primary_business; ?>
												</td>
									</tr>
									<?php if(!empty($other_primary_business)){ ?>
										<tr>
											<td style="padding:5px;border:solid 1px #ddd;">Other Primary Business</td>
											<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $other_primary_business; ?>
													</td>
										</tr>
									<?php } ?>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Company Website</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $company_website; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Company Address</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $company_address; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">City</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $city; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Zip</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $zip; ?>
												</td>
									</tr>

									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">State</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $state; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Country</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $country; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">No of Employee</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $no_emp; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Primary Customer</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $prime_customer; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Wireless Product</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $wireless_product; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Network Product</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $network_product; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Interested in Product</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $product_in_interested; ?>
												</td>
									</tr>
									<?php if(!empty($other_product_in_interested)){ ?>
										<tr>
											<td style="padding:5px;border:solid 1px #ddd;">Other Interested in Product</td>
											<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $other_product_in_interested; ?>
													</td>
										</tr>
									<?php } ?>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">How you about us</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $how_know_about; ?>
												</td>
									</tr>
									<tr>
										<td style="padding:5px;border:solid 1px #ddd;">Current opportunities</td>
										<td style="text-align:left;padding:5px;border:solid 1px #ddd;"><?php echo $current_oppo; ?>
												</td>
									</tr>
								</table>
								<?php 
									if(isset($_FILES['investor']['name']) && !empty($_FILES['investor']['name'])){
								?>
								<div style="float:right; margin:20px 0 0 0; text-align:center;color:#2a8e9d">
									<div>
										<strong style="color:#2a1966;">
											<a href="<?php echo BASE_URL."/images/attachment/".$investor; ?>" style="font-size:14px; color:#2a1966;">Your Attachment</a>
										</strong>
									</div>
								</div>
								<?php } ?>
							</div>
							<div style="border-top:1px solid #ddd; margin-top:100px; font-size:15px; text-align:center; padding:20px; color:#848484">
								Contact customer care at ioenquiry@hfcl.com or call 0124-4310000 in case of any query
							</div>
						</div>

						</font>
                    </td>
                </tr>
            </table>           
		</td>
    </tr>
</table>
</body>
</html>

<?php 
	$invoiceMsg = ob_get_contents();
	ob_end_clean();
?>