<?php
	include_once 'include/functions.php';
   	$functions = new Functions();
	//include("include/php-variables.php");
	//error_reporting(E_ALL);

		$sql ="select * from ".PREFIX."doc_cms ";
	   $query = $functions->query($sql);
	   $emsCMS = $functions->fetch($query);
	   $bannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['image_name'], 'crop', '');

	if(isset($_POST['submitContactForm'])){
		$chatSessionId = $_COOKIE["chatSessionId"];
		$chatSessionId = $functions->escape_string($functions->strip_all($chatSessionId));
		$first_name = $functions->escape_string($functions->strip_all($_POST['first_name']));
		$last_name = $functions->escape_string($functions->strip_all($_POST['last_name']));
		$mobile = $functions->escape_string($functions->strip_all($_POST['mobile']));
		$email = $functions->escape_string($functions->strip_all($_POST['email']));
		$company_name = $functions->escape_string($functions->strip_all($_POST['company_name']));
		$designation = $functions->escape_string($functions->strip_all($_POST['designation']));
		$country = $functions->escape_string($functions->strip_all($_POST['country']));
		if(isset($_POST['city'])){
			$city = $functions->escape_string($functions->strip_all($_POST['city']));
		}else{
			$city = "";
		}
		$product_id = $functions->escape_string($functions->strip_all($_POST['productData']));

		$sql = "insert into ".PREFIX."document_download_request(chatSessionId, first_name, last_name, mobile, email, company_name, designation, country, city, product_id)VALUES('".$chatSessionId."', '".$first_name."', '".$last_name."', '".$mobile."', '".$email."', '".$company_name."', '".$designation."', '".$country."', '".$city."', '".$product_id."')";
		$functions->query($sql);
		$prDetails = $functions->getUniqueProductById($product_id);
		$permalink = $functions->escape_string($functions->strip_all($prDetails['permalink']));
   		$productDetails = $functions->getProductByproductPermalink($permalink);
		$subcategoryDetails = $functions->getUniqueSubCategoryById($prDetails['sub_category_id']);
		print_r($prDetails);
		$fileCnt=0;

		$data_sheet = "";
		$product_id = $functions->encryptValue($product_id);
		if(!empty($prDetails['data_sheet'])){
			$fileCnt++;
			$data_sheet = $chatSessionId."&ftype=data_sheet&pd=".$product_id;
		}
		$user_start_guide ="";
		if(!empty($prDetails['user_start_guide'])){
			$fileCnt++;
			$user_start_guide = $chatSessionId."&ftype=user_start_guide&pd=".$product_id;
		}

		$start_guide ="";
		if($prDetails['display_user_manual'] > 0){
			$fileCnt++;
			$start_guide = $chatSessionId."&ftype=start_guide&pd=".$product_id;
		}

		$brochure ="";
		if(!empty($prDetails['brochure'])){
			$fileCnt++;
			$brochure = $chatSessionId."&ftype=brochure&pd=".$product_id;
		}

		$noFileMessage="";
		if($fileCnt == 0){
			$noFileMessage = "No files are added in this product";
		}

		include_once("include/emailers/download-resource.php");
		include_once("include/classes/Email.class.php");
		$to = $email;
		$subject = SITE_NAME." | Download Resources";
		$emailObj = new Email();
		$emailObj->setSubject($subject);
		$emailObj->setEmailBody($emailMsg);
		$emailObj->setAddress($to);
		$emailObj->sendEmail();
		//$emailObj->setAddress("iosupport@hfcl.com");
		//$emailObj->sendEmail();
		//$emailObj->setAddress("iosales@hfcl.com");
		//$emailObj->sendEmail();
		header("location: ".BASE_URL."/Documentation/Resource-Download");
		exit();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> || Documentation </title>
	<meta name="description" content="Explore industry-leading network solutions, driving super experiences for consumers with our datasheets and brochures.">
	<?php include("include/header-link.php");?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body class="innerpage documentationpage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo $bannerImageData?>" alt="docbanner" class="inbanner">
			<!-- <img src="images/catbanimg.png" alt="catbanimg" class="cenbanimg"> -->
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $emsCMS['title']; ?></h1>
					<p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $emsCMS['description']; ?></p>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<!-- <li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Resources</a></li> -->
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);">Documentation</a></li>
				</ul>
			</div>
		</section>
		
		<section class="documentation-section">
			<div class="container p0">
				<div class="documentation-in">

					<p>Select the product category and subcategory to view the respective documents</p>

					<form class="docfilter">
						<select name="product_category" id="category_id" class="selectpick">
							<option selected disabled focus>Select Product Category</option>
							<?php
								$query = $functions->query("select * from ".PREFIX."category_master where active='1' ");
								while($row = $functions->fetch($query)) {
							?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
							<?php } ?>
						</select>
						<select name="product_sub_category" id="sub_category_id" class="selectpick" title="Select Sub-Category">
						</select>
						<select name="product" id="product_id" class="selectpick" title="Select Product">
						</select>
					</form>
					<div class="result-box">
						<div class="result-flex">
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

		<div style="display: none;" id="content" class="contentclass">
		<h2>To Download, Please Fill the Form</h2>
		<form class="formclass" method="POST" id="submitDocumentationForm" autocomplete="off">
			<div class="form-group">
				<input type="text" name="first_name" class="form-control" placeholder="First Name">
			</div>
			<div class="form-group">
				<input type="text" name="last_name" class="form-control" placeholder="Last Name">
			</div>
			<div class="form-group">
				<input type="text" name="mobile" class="form-control validateMobileClass" placeholder="Mobile No">
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Company Email id">
			</div>
			<div class="form-group">
				<input type="text" name="company_name" class="form-control" placeholder="Company Name">
			</div>
			<div class="form-group">
				<input type="text" name="designation" class="form-control" placeholder="Designation">
			</div>
			<div class="form-group">
				<select name="country" onchange="checkCountry(this.value);" class="form-control checkcountryvalidation">
					<option selected disabled focus>Country</option>
						<?php 
							$sql = $functions->query("select * from ".PREFIX."country_master where is_deleted='0' AND active='1' ");
							while($countryDetails = $functions->fetch($sql)){
						?>
					<option <?php if($countryDetails['country_name'] == ''){ echo 'selected'; }?> value="<?php echo $countryDetails['country_name']; ?>"><?php echo $countryDetails['country_name']; ?></option>
						<?php } ?>
				</select>
			</div>
			<div class="form-group onchcontry">
						<input type="text" name="city" class="form-control" placeholder="Enter City" required>
				<?php /*<select name="city" id="cityContact" class="form-control">
					<?php 
						$sqlCity = $functions->query("select * from ".PREFIX."city_master where is_deleted='0' AND active='1' AND country_id='101' ORDER BY city_name ASC");
							while($cityDetails = $functions->fetch($sqlCity)){
						?>
							<option value="<?php echo $cityDetails['city_name']; ?>"><?php echo $cityDetails['city_name']; ?></option>
					<?php } ?>
				</select>*/ ?>
			</div>
			<div class="btnbox">
				<input type="hidden" name="productData" id="productData" value="" >
				<button type="submit" name="submitContactForm">Submit</button>
				<p class="redtext">All fields are mandatory</p>
			</div>
		</form>
	</div>

	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#submitDocumentationForm").validate({
				ignore: [],
				debug: false,
				rules: {
					first_name:{
						required:true,
						lettersonly: true
					},
					last_name:{
						required:true,
						lettersonly: true
					},
					mobile:{
						required:true,
						number:true
					},
					email:{
						required:true,
						email:true,
						remote:{
                           url:"ajax-check-email-contains.php",
                           type: "post"
                        }
					},
					company_name:{
						required:true
					},
					designation:{
						required:true,
						lettersonly: true
					},
					country:{
						required:true
					},
					city:{
						required:true,
						lettersonly:true
					}
				},
				messages: {
					email:{
						remote:"gmail/yahoo/hotmail and rediff email id is not allowed."
					},
					image_name: {
						extension: "Please upload jpg or png image"
					},
					investor:{
						extension: "Please upload pdf only",
						filesize:"Max 5 MB file size allowed"
					}
				}
			});  
		   $(".fancyboxbtn").fancybox({
	             clickSlide: false,
	             clickOutside: false,
	             touch: false
	         });


            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");
		});

		$(document).ready(function(){
			$('.selectpick').selectpicker();
		})

	</script>
	<script type="text/javascript">
		function getProductsBySubCategory() {
			var sub_category_id = $("#sub_category_id").val();
			$.ajax({
				url:"ajaxGetProductsByAubCategoryId.php",
				data:{sub_category_id:sub_category_id},
				type:"POST",
				success: function(response){
					var response = JSON.parse(response);
					$("#product_id").html(response);
					$("#product_id").selectpicker('refresh');
					$("#product_id").trigger("change");
					var blVal = "";
					$(".result-flex").html(blVal);
				},
				error: function(){
					alert("Unable to add to cart, pleases try again");
				},
				complete: function(response){
					
				}
			}).then(function (response) {
				$("#product_id").html(response);
				$("#product_id").selectpicker('refresh');
			});;
		}

		$(document).ready(function() {
			$('#sub_category_id').on("change",getProductsBySubCategory);
			$("#category_id").on("change", function(){
				var category_id = $(this).val();
				$.ajax({
					url:"ajaxGetSubCategoryByCategoryId.php",
					data:{category_id:category_id},
					type:"POST",
					success: function(response){
						$("#sub_category_id").html(response);
						$("#sub_category_id").selectpicker('refresh');
						$("#sub_category_id").trigger("change");
						var blVal = "";
						$(".result-flex").html(blVal);
					},
					error: function(){
						alert("Unable to get content, please try again");
					},
					complete: function(response){
						
					}
				});
			});

			$("#product_id").on("change", function(){
				var product_id = $(this).val();
				$.ajax({
					url:"ajaxGetProductDetails.php",
					data:{product_id:product_id},
					type:"POST",
					success: function(response){
						$("#productData").val(product_id);
						$(".result-flex").html(response);
					},
					error: function(){
						alert("Unable to get content, please try again");
					},
					complete: function(response){
						
					}
				});
			});
		});
	</script>



	
</body>
</html>