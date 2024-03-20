<?php
	include_once 'include/functions.php';
	
	  	$functions = new Functions();
	
	include("include/php-variables.php");
	
	$column = "";
	
	$nofileFound = "";
	
	if(isset($_GET['dataDownload']) && !empty($_GET['dataDownload']) && isset($_GET['ftype']) && !empty($_GET['ftype']) && isset($_GET['pd']) && !empty($_GET['pd'])){
	
		$dataDownload = $functions->escape_string($functions->strip_all($_GET['dataDownload']));
	
		$ftype = $functions->escape_string($functions->strip_all($_GET['ftype']));
	
		$pd = $functions->escape_string($functions->strip_all($_GET['pd']));
	
		if(isset($_COOKIE["chatSessionId"])){
	
		    $chatSessionId = $dataDownload;
	
		    if($chatSessionId == $_COOKIE["chatSessionId"]){
	
			    $column = $ftype;
	
		    	$product_id = $functions->descryptValue($pd);
	
				$prDetails = $functions->getUniqueProductById($product_id);
	
				$url = BASE_URL."/images/product/".$prDetails[$column];
	
		    }else{
	
		    	//$nofileFound = "Sorry! You are not allowed to download this file.";
		    	$nofileFound = "We regret there is no file available for this product.";
	
		    }
	
		}else{
	
			$nofileFound = "We regret there is no file available for this product.";
	
		}
	
	}else{
	
	$nofileFound = "We regret there is no file available for this product.";
	
	}
	
	?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $websitename; ?> || Download </title>
		<?php include("include/header-link.php");?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	</head>
	<body class="innerpage documentationpage">
		<main class="root">
			<?php include("include/header.php");?>
			<section class="innerpagebanner-section mtop">
				<img src="<?php echo BASE_URL; ?>/images/slider-banner/1633322110-1_crop.jpg" alt="docbanner" class="inbanner">
				<img src="<?php echo BASE_URL; ?>/images/catbanimg.png" alt="catbanimg" class="cenbanimg">
				<div class="inbantext">
					<div class="container p0">
						<h1 class="wow fadeInUp" data-wow-delay="0.5s">Download</h1>
						<!-- <p class="wow fadeInUp" data-wow-delay="0.5s">Download</p> -->
					</div>
				</div>
			</section>
			<section class="breadcrumb-section">
				<div class="container p0">
					<ul class="breadcrumb-in">
						<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
						<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/documentation">Documentation</a></li>
						<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Download</a></li>
					</ul>
				</div>
			</section>
			<section class="documentation-section">
				<div class="container p0">
					<div class="documentation-in">

							<!-- <a data-fancybox data-src="#modal1" href="javascript:" class="fancyboxbtn">Download</a> -->

						<?php 
							if(!empty($nofileFound)){ 
							
								echo $nofileFound;
							
							?>
						<?php } ?>
						<div class="result-box">
							<div class="result-flex">
								<?php 
									if($column == 'data_sheet'){
									
									?>
								<div class="result-sub match">
									<img src="<?php echo BASE_URL; ?>/images/resultwifi.png" alt="resultwifi">
									<h4>Datasheet</h4>
									<a download href="<?php echo $url; ?>" class="fancyboxbtn" onclick="keepdownloadrecord('data_sheet', '<?php echo $product_id; ?>', '<?php echo $_COOKIE["chatSessionId"]; ?>');">Download</a>
								</div>
								<?php
									}
									
									?>
								<?php 
									if($column == 'user_start_guide'){
									
									?>
								<div class="result-sub match">
									<img src="<?php echo BASE_URL; ?>/images/resultwifi.png" alt="resultwifi">
									<h4>Quick Start Guide</h4>
									<a download href="<?php echo $url; ?>" class="fancyboxbtn" onclick="keepdownloadrecord('user_start_guide', '<?php echo $product_id; ?>', '<?php echo $_COOKIE["chatSessionId"]; ?>');">Download</a>
								</div>
								<?php
									}
									
									?>
								<?php 
									if($column == 'start_guide'){
									
									?>
								<div class="result-sub match">
									<img src="<?php echo BASE_URL; ?>/images/resultwifi.png" alt="resultwifi">
									<h4>User Manual</h4>
									<a class="fancyboxbtn" data-fancybox data-src="#modal" onclick="keepdownloadrecord('start_guide', '<?php echo $product_id; ?>', '<?php echo $_COOKIE["chatSessionId"]; ?>');">Download</a>  <!-- SHANKAR PLEASE CODE HERE. IF WE CLICK ON THIS DOWNLOAD BUTTON THEN A POP UP SHOULD BE COME WITH MESSAGE "Thank you for your request, our sales team will get in touch with you shortly."  -->
									<div style="display: none;" id="modal" class="thankyoupopup">
										<img src="<?php echo BASE_URL; ?>/images/checked.png" alt="checked">
										<p>Thank you for your request to access the user manual. Our sales representative will contact you and guide you further and enable access at the earliest.</p>
										<br>
										<h5>Warm Regards,</h5>
										<h6>IO By HFCL</h6>
									</div>
								</div>
								<?php
									}
									
									?>
								<?php 
									if($column == 'brochure'){
									
									?>
								<div class="result-sub match">
									<img src="<?php echo BASE_URL; ?>/images/resultwifi.png" alt="resultwifi">
									<h4>Brochure</h4>
									<a download href="<?php echo $url; ?>" class="fancyboxbtn" onclick="keepdownloadrecord('brochure', '<?php echo $product_id; ?>', '<?php echo $_COOKIE["chatSessionId"]; ?>');">Download</a>
								</div>
								<?php
									}
									
									?>
							</div>
						</div>
					</div>
				</div>
			</section>

			
		</main>
		<?php include("include/footer.php");?> 
		<?php include("include/footer-link.php");?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		<script type="text/javascript">
			function keepdownloadrecord(fileType, productId, chatSessionId) {
			
				$.ajax({
			
					url:"ajax-update-download-history.php",
			
					data:{fileType:fileType, productId:productId, chatSessionId:chatSessionId, },
			
					type:"POST",
			
					success: function(response){
			
					},
			
					error: function(){
			
						alert("Unable to add to cart, pleases try again");
			
					},
			
					complete: function(response){
			
						
			
					}
			
				}).then(function (response) {
			
				});;
			
			}
			
		</script>
	</body>
</html>