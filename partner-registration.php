<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $_POST['email'] = "uic.15bca1321@gmail.com";
   if(isset($_POST['email']) && !empty($_POST['email'])){
   	$email = $functions->escape_string($functions->strip_all($_POST['email']));
   }else{
   	header("location: Partner/Become-a-Partner");
		exit();
   }

   $sql ="select * from ".PREFIX."partnership_form_cms ";
   $query = $functions->query($sql);
   $emsCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['image_name'], 'crop', '');


   if(isset($_POST['submit'])){
	$_POST['personal_email_id'] = "upadhyaykinu@gmail.com";
	$_POST['product_in_interested'] = implode(',', $_POST['product_in_interested']);
   	$company_name= $functions->escape_string($functions->strip_all($_POST['company_name']));
	   $primary_market= $functions->escape_string($functions->strip_all($_POST['primary_market']));
	   $primary_business= $functions->escape_string($functions->strip_all($_POST['primary_business']));
	   $company_nature= $functions->escape_string($functions->strip_all($_POST['company_nature']));
	   $company_website= $functions->escape_string($functions->strip_all($_POST['company_website']));
	   $company_address= $functions->escape_string($functions->strip_all($_POST['company_address']));
	   $city= $functions->escape_string($functions->strip_all($_POST['city']));
	   $zip= $functions->escape_string($functions->strip_all($_POST['zip']));
	   $state= $functions->escape_string($functions->strip_all($_POST['state']));
	   $country= $functions->escape_string($functions->strip_all($_POST['country']));
	   $no_emp= $functions->escape_string($functions->strip_all($_POST['no_emp']));
	   $prime_customer= $functions->escape_string($functions->strip_all($_POST['prime_customer']));
	   $wireless_product= $functions->escape_string($functions->strip_all($_POST['wireless_product']));
	   $network_product= $functions->escape_string($functions->strip_all($_POST['network_product']));
	   $product_in_interested= $functions->escape_string($functions->strip_all($_POST['product_in_interested']));
	   $how_know_about= $functions->escape_string($functions->strip_all($_POST['how_know_about']));
	   $current_oppo= $functions->escape_string($functions->strip_all($_POST['current_oppo']));
	   $personal_first_name= $functions->escape_string($functions->strip_all($_POST['personal_first_name']));
	   $personal_last_name= $functions->escape_string($functions->strip_all($_POST['personal_last_name']));
	   $personal_mobile_no= $functions->escape_string($functions->strip_all($_POST['personal_mobile_no']));
	   $personal_email_id= $functions->escape_string($functions->strip_all($_POST['personal_email_id']));
	   $personal_designation= $functions->escape_string($functions->strip_all($_POST['personal_designation']));
	   $email= $functions->escape_string($functions->strip_all($_POST['email']));
	   $other_product_in_interested= $functions->escape_string($functions->strip_all($_POST['other_product_in_interested']));
	   $other_primary_business= $functions->escape_string($functions->strip_all($_POST['other_primary_business']));

	   $investor = "";
		$investor_name = "";
		$imgDir = 'images/attachment/';

   	if(isset($_FILES['investor']['name']) && !empty($_FILES['investor']['name'])){
   		$investor = $email.time();
         $file_tmp  = $_FILES['investor']['tmp_name'];
         $investor_name  = $_FILES['investor']['name'];
         move_uploaded_file($file_tmp,$imgDir.$investor);
   	}


		$sqlInsert = "insert into ".PREFIX."partnership_form_details(company_name, primary_market, primary_business, company_nature, company_website, company_address, city, zip, state, country, no_emp, prime_customer, wireless_product, network_product, product_in_interested, how_know_about, current_oppo, personal_first_name,  personal_last_name,   personal_mobile_no,  personal_email_id, personal_designation, email, investor, investor_name, other_product_in_interested, other_primary_business)VALUES('".$company_name."', '".$primary_market."', '".$primary_business."', '".$company_nature."', '".$company_website."', '".$company_address."', '".$city."', '".$zip."', '".$state."', '".$country."', '".$no_emp."', '".$prime_customer."', '".$wireless_product."', '".$network_product."', '".$product_in_interested."', '".$how_know_about."', '".$current_oppo."', '".$personal_first_name."', '".$personal_last_name."', '".$personal_mobile_no."', '".$personal_email_id."', '".$personal_designation."',  '".$email."', '".$investor."', '".$investor_name."', '".$other_product_in_interested."', '".$other_primary_business."')";
		$query = $functions->query($sqlInsert);


		include_once("include/emailers/partenership-form-filled-mail.php");
		include_once("include/classes/Email.class.php");
		$to = $email;
		$sendEmailArr = array();
		$sendEmailArr[] = $to;
		// $sendEmailArr[] = "iosales@hfcl.com";
		 $sendEmailArr[] = "uic.15bca1245@gmail.com";

		$subject = SITE_NAME." | Partner Registration";
		$emailObj = new Email();
		$emailObj->setSubject($subject);
		$emailObj->setEmailBody($invoiceMsg);
		foreach($sendEmailArr as $sendEmailId){
			$emailObj->setAddress($sendEmailId);
			$emailObj->sendEmail();
		}
		header("location: ".BASE_URL."/Become-a-Partner/Thank-You");
		exit();
   }
   


   if(isset($_POST['productTrainingform'])){
	$name = $functions->escape_string($functions->strip_all($_POST['fname']));
	$lname = $functions->escape_string($functions->strip_all($_POST['lname']));
	$mobile = $functions->escape_string($functions->strip_all($_POST['mobile']));
	$email = $functions->escape_string($functions->strip_all($_POST['email']));
	$country = $functions->escape_string($functions->strip_all($_POST['country']));
	if(isset($_POST['city'])){
		$city = $functions->escape_string($functions->strip_all($_POST['city']));
	}else{
		$city="";
	}
	if(isset($_POST['state'])){
		$city = $functions->escape_string($functions->strip_all($_POST['state']));
	}else{
		$city="";
	}
	$designation = $functions->escape_string($functions->strip_all($_POST['designation']));
	$organization = $functions->escape_string($functions->strip_all($_POST['organization']));
	$sqlInsert = "insert into ".PREFIX."product_training_details(firstname, lastname, mobile, email, country, city, designation, organization,state)VALUES('".$name."', '".$lname."', '".$mobile."', '".$email."', '".$country."', '".$city."', '".$designation."', '".$organization."', '".$state."' )";
	$queryInsert = $functions->query($sqlInsert);

	header("location: ".BASE_URL."/Become-a-Partner/Thank-You");
	exit();
}



?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> || Partner Registration </title>
	<?php include("include/header-link.php");?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body class="innerpage contactuspage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo $bannerImageData; ?>" alt="contactus" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $emsCMS['title']; ?></h1>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/partner">Partner</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Partner Registration</a></li>
				</ul>
			</div>
		</section>
		<section class="registrationform-section">
			<div class="container p0">

				<div class="registrationform-in">
					<h3>PARTNER REGISTRATION FORM</h3>
					<p>If your company has not been registered yet, please fill out the details below to apply for partnership. Once your company has been approved, your account will be activated.</p>
					<h6>(All fields marked * are mandatory)</h6>

					<div class="regformbox">
						<form class="registrationform" id="submitPartnerForm" autocomplete="off" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Company Name <em>*</em></label>
								<input type="text" name="company_name" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>Primary Vertical Market <em>*</em></label>
								<select name="primary_market" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="CCTV/Security">CCTV/Security</option>
									<option value="Education">Education</option>
									<option value="Enterprise/ Business Broadcast">Enterprise/ Business Broadcast</option>
									<option value="Healthcare">Healthcare</option>
									<option value="Hospitality">Hospitality</option>
									<option value="Mining & Mineral">Mining & Mineral</option>
									<option value="TSP/ISP/PDOA">TSP/ISP/PDOA</option>
									<option value="Oil & Gas">Oil & Gas</option>
									<option value="Public Wi-Fi">Public Wi-Fi</option>
									<option value="Residential Broadband">Residential Broadband</option>
									<option value="Retail">Retail</option>
									<option value="Smart cities">Smart cities</option>
									<option value="State/Local Government">State/Local Government</option>
									<option value="Central Govt/PSU">Central Govt/PSU</option>
									<option value="Transportation/Utilities">Transportation/Utilities</option>
								</select> 
							</div>
							<div class="form-group">
								<label>Primary Business <em>*</em></label>
								<select name="primary_business" onchange="checkOtherVal2(this.value);" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="Value Added Distributor">Value Added Distributor</option>
									<option value="System Integrator">System Integrator</option>
									<option value="ISP">ISP</option>
									<option value="Telecom Operator">Telecom Operator</option>
									<option value="Value Added Reseller">Value Added Reseller</option>
									<option value="Stockist">Stockist</option>
									<option value="Managed Service Provider">Managed Service Provider</option>
									<option value="Others">Others</option>
								</select> 
							</div>
							<div class="form-group other_primary_business" style="display:none;">
								<label>Other Primary Business <em>*</em></label>
								<input type="text" name="other_primary_business" id="other_primary_business" class="form-control"> 
							</div>
							<div class="form-group">
								<label>Nature of the company <em>*</em></label>
								<select name="company_nature" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="PSU">PSU</option>
									<option value="Public Ltd">Public Ltd.</option>
									<option value="Pvt Ltd">Pvt Ltd.</option>
									<option value="LLP">LLP</option>
									<option value="Inc">Inc</option>
									<option value="Proprietorship">Proprietorship</option>
									<option value="Partnership Firm">Partnership Firm</option>
								</select> 
							</div>
							<div class="form-group">
								<label>Company Website</label>
								<input type="text" name="company_website" class="form-control"> 
							</div>
							<div class="form-group">
								<label>Company Address <em>*</em></label>
								<input type="text" name="company_address" class="form-control"> 
							</div>
							<div class="form-group">
								<label>City <em>*</em></label>
								<input type="text" name="city" class="form-control"> 
								<!-- <select name="city" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Madrid">Madrid</option>
									<option value="Paris">Paris</option>
								</select>  -->
							</div>
							<div class="form-group">
								<label>ZIP/Postal Code <em>*</em></label>
								<input type="text" name="zip" class="form-control"> 
							</div>
							<div class="form-group">
								<label>State/Province/Region <em>*</em></label>
								<input type="text" name="state" class="form-control"> 
								<!-- <select name="state" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="Maharashtra">Maharashtra</option>
									<option value="MP">MP</option>
									<option value="Punjab">Punjab</option>
								</select>  -->
							</div>
							<div class="form-group">
								<label>Country <em>*</em></label>


								<select name="country"  class="form-control selctpic checkcountryvalidation">

									<option selected disabled focus>-- Select --</option>
									<?php 
										$sql = $functions->query("select * from ".PREFIX."country_master where is_deleted='0' AND active='1' ");
										while($countryDetails = $functions->fetch($sql)){

									?>
										<option <?php if($countryDetails['country_name'] == ''){ echo 'selected'; }?> value="<?php echo $countryDetails['country_name']; ?>"><?php echo $countryDetails['country_name']; ?></option>
									<?php } ?>

								</select>
								<!-- <select name="country" class="form-control selctpic">
									<option selected disabled focus>-- Select --</option>
									<option value="India">India</option>
									<option value="France">France</option>
									<option value="Spain">Spain</option>
								</select>  -->
							</div>
							<div class="divwrap">
								<div class="form-group">
									<label>Number of Employees <em>*</em></label>
									<select name="no_emp" class="form-control selctpic">
										<option selected disabled focus>-- Select --</option>
										<option value="Upto 10">Upto 10</option>
										<option value="Between 10 to 50">Between 10 to 50</option>
										<option value="Between 50 to 100">Between 50 to 100</option>
										<option value="More than 100">More than 100</option>
									</select> 
								</div>
								<div class="form-group">
									<label>Your Primary Customer <em>*</em></label>
									<select name="prime_customer" class="form-control selctpic">
										<option selected disabled focus>-- Select --</option>
										<option value="Enterprise">Enterprise</option>
										<option value="Central Government">Central Government</option>
										<option value="PSUs">PSUs</option>
										<option value="State Government">State Government</option>
										<option value="ISP">ISP</option>
										<option value="Mobile Operator">Mobile Operator</option>
										<option value="Railways">Railways</option>
										<option value="Defense">Defense</option>
										<option value="Education">Education</option>
										<option value="Box Selling">Box Selling</option>
										<option value="Export">Export</option>
									</select> 
								</div>
							</div>
							<div class="form-group label100">
								<label>Please enter percentage of revenue your company derives from the following</label>
								<div class="subgrps">
									<h6>RF & Wireless Products</h6>
									<select name="wireless_product" onchange="checkwireless(this.value);" class="form-control selctpic wireless_product">
										<option value="0">0</option>
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
										<option value="60">60</option>
										<option value="70">70</option>
										<option value="80">80</option>
										<option value="90">90</option>
										<option selected value="100">100</option>
									</select> 
									<span>%</span>
								</div>
								<div class="subgrps">
									<h6>Networking Products</h6>
									<select name="network_product" onchange="checknetwork(this.value);" class="form-control selctpic network_product">
										<option value="0">0</option>
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
										<option value="60">60</option>
										<option value="70">70</option>
										<option value="80">80</option>
										<option value="90">90</option>
										<option value="100">100</option>
									</select> 
									<span>%</span>
								</div>
							</div>
							<div class="form-group width100-md">
								<label>Total Revenue from <br>Sales and services in <br>last fiscal year<em>*</em></label>
								<div class="custom-file">
                           <input class="custom-file-input" id="customFile" name="investor" type="file">
                           <label class="custom-file-label" id="customFilelabel" for="customFile">Upload File 5MB(pdf)</label>
                        </div>
							</div>
							<div class="wrapmargin">
								<div class="divwrap">
									<div class="form-group">
										<label>Products you are <br>interested in</label>
										<select name="product_in_interested[]" multiple="multiple" onchange="checkOtherVal(this.value);" class="form-control selctpic">
											<option selected disabled focus>-- Select --</option>
											<option value="Access Points">Access Points</option>
											<option value="Managed Switches">Managed Switches</option>
											<option value="UBRs">UBRs</option>
											<option value="Accessories">Accessories</option>
											<option value="PoE Injectors">PoE Injectors</option>
											<option value="Antennas">Antennas</option>
											<option value="Cloud Network Management System">Cloud Network Management System</option>
											<option value="Element Management System">Element Management System</option>
											<option value="Wireless LAN Controller">Wireless LAN Controller</option>
											<option value="Others">Others</option>
										</select> 
									</div>
									<div class="form-group other_product_in_interested" style="display:none;">
										<label>Other Products you are <br>interested in <em>*</em></label>
										<input type="text" name="other_product_in_interested" id="other_product_in_interested" class="form-control"> 
									</div>
									<div class="form-group">
										<label>How did you know <br>about us</label>
										<select name="how_know_about" class="form-control selctpic">
											<option selected disabled focus>-- Select --</option>
											<option value="Through Customer">Through Customer</option>
											<option value="Through HFCL Distributor">Through HFCL Distributor</option>
											<option value="Through HFCL Employee">Through HFCL Employee</option>
											<option value="Through Pre-Bid">Through Pre-Bid</option>
										</select> 
									</div>
								</div>
								<div class="form-group">
									<label>Current opportunities for HFCL/IO products or services:</label>
									<textarea class="form-control textclass" name="current_oppo"></textarea>
									<p>300 characters</p>
								</div>
							</div>

							<div class="personalinfobox">
								<h4>PERSONAL INFORMATION <em>*</em></h4>
								<div class="form-group">
									<label>First Name <em>*</em></label>
									<input type="text" name="personal_first_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Last Name <em>*</em></label>
									<input type="text" name="personal_last_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Mobile No <em>*</em></label>
									<input type="text" name="personal_mobile_no" class="form-control validateMobileClass" required> 
								</div>
								<!-- <div class="form-group">
									<label>Email ID <em>*</em> <br><span>(OFFICIAL)</span></label>
									<input type="email" name="personal_email_id" class="form-control" required> 
								</div> -->
								<div class="form-group">
									<label>Designation <em>*</em></label>
									<input type="text" name="personal_designation" class="form-control" required> 
								</div>
							</div>
							<div class="tancbox">
								<h4>TERMS AND CONDITIONS <em>*</em></h4>
								<div class="tcwrap">
									<input type="checkbox" name="tc" id="tccheck" required>
									<label for="tccheck">I agree to the <a href="<?php echo BASE_URL;?>/partner-terms-and-conditions">terms and conditions</a> of the Partner Registration Program.</label>
								</div>
							</div>

				         <!-- <div class="recaptcha-div">
				            <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-sitekey="6LclOxAdAAAAAIQKSWYTCUhGkXsIFdFigZOabJZn"></div>
				         </div> -->
				         <input type="hidden" name="email" value="<?php echo $email; ?>">
				         <button type="submit" name="submit" class="regsubmit">Submit</button>
						</form>
					</div>

				</div>
			</div>
		</section>
	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script>
		function checkwireless(wireless){
			var value = wireless;
			var deductedval = 100 - value;
			$(".network_product").val(deductedval);
			$(".network_product").selectpicker('refresh');

		}

		function checknetwork(network){
			var value = network;
			var deductedval = 100 - value;
			$(".wireless_product").val(deductedval);
			$(".wireless_product").selectpicker('refresh');
		}


		function checkOtherVal(cheData){
			if(cheData == 'Others'){
				$(".other_product_in_interested").show();
				$("#other_product_in_interested").attr("required", true);
			}else{
				$("#other_product_in_interested").attr("required", false);
				$("#other_product_in_interested").val("");
				$(".other_product_in_interested").hide();
			}
		}

		function checkOtherVal2(cheData){
			if(cheData == 'Others'){
				$(".other_primary_business").show();
				$("#other_primary_business").attr("required", true);
			}else{
				$("#other_primary_business").attr("required", false);
				$("#other_primary_business").val("");
				$(".other_primary_business").hide();
			}
		}

            // $(document).ready(function(){
            //   $("#submitPartnerForm").submit(function(event) {
            //       var recaptcha = $("#g-recaptcha-response").val();
            //       if (recaptcha === "") {
            //         event.preventDefault();
            //         alert("Please check the recaptcha");
            //       }
            //    }); 
            // }); 
         </script>
	<script type="text/javascript">

		$(document).ready(function(){
			$('.selctpic').selectpicker();
		});

		// $('#customFile').on('change',function(event){
        //  var files = event.target.files;
        //  console.log(files);
        //  var filename = $('#customFile').val().split('\\').pop();
        //  $('#customFilelabel').html(filename);
        //  /* for (var i = 0; i < files.length; i++) {
        //     	var file = files[i];
        //        $(this).next('#customFilelabel').addClass("selected").val().replace(/.*(\/|\\)/, '');
        //   	 }*/
        //  });

	</script>
</body>
</html>