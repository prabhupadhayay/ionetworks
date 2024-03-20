<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

   if(isset($_GET['permalink']) && !empty($_GET['permalink'])){
   		$permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
   		$industryDetails = $functions->getIndustryDetailsByPermalink($permalink);
   		$bannerImage = $functions->getImageUrl('industry', $industryDetails['detail_banner_image'], 'crop', '');
   		$image_name = $functions->getImageUrl('industry', $industryDetails['image_name'], 'crop', '');
   		$detail_image1 = $functions->getImageUrl('industry', $industryDetails['detail_image1'], 'crop', '');
   		$detail_image2 = $functions->getImageUrl('industry', $industryDetails['detail_image2'], 'crop', '');
   }else{
   	header("location: ".BASE_URL."/industries");
		exit();
   }
?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || <?php echo $industryDetails['name']; ?> </title>
    <?php if($industryDetails['name'] == "TSP/ISP"): ?>
		<meta name="description" content="With Mobile Data Offloading becoming a critical data strategy for telecom players, IO by HFCL enhances the related processes and offloads tremendous amount of total traffic load">
    <?php elseif ($industryDetails['name'] == "Education"): ?>
	<meta name="description" content="IO by HFCL is stiving to establish connected campuses for ease of access to educational resources through a well-knit system">
	<?php elseif ($industryDetails['name'] == "Healthcare"): ?>
	<meta name="description" content="IO by HFCL is enabling robust connectivity for healthcare be it remote functioning or emergency healthcare situations">
	<?php elseif ($industryDetails['name'] == "smart-home"): ?>
	<meta name="description" content="In the era of smart gadgets, IO by HFCL is bulding efficient smart homes to maintain highly functional automated home requirements">
	<?php elseif ($industryDetails['name'] == "Public Wi-Fi"): ?>
	<meta name="description" content="IO by HFCL delivers highly adaptable network solutions for the aviation industry with an ultra-secure network architecture">
	<?php elseif ($industryDetails['name'] == "Public Hotspots"): ?>
	<meta name="description" content="IO by HFCL establishes easy accessibilty with public wireless networks for exceptional access to the Internet outside usual work environment">
	<?php elseif ($industryDetails['name'] == "Mining"): ?>
	<meta name="description" content="IO by HFCL provides reliable underground wireless connectivity for remote field operations, solving the challenges of mission-critical affairs">
	<?php elseif ($industryDetails['name'] == "Mining"): ?>
	<meta name="description" content="IO by HFCL provides reliable underground wireless connectivity for remote field operations, solving the challenges of mission-critical affairs">
	<?php elseif ($industryDetails['name'] == "Defence"): ?>
	<meta name="description" content="IO by HFCL offers field-tested Wi-Fi solutions that are critical for military operations for real-time situational awareness">
	<?php elseif ($industryDetails['name'] == "SMEs"): ?>
	<meta name="description" content="Owing to the fast-growth demand of SMEs, IO by HFCL offers hassle-free connectivity to enhance productivity and accelerate business operations at a pace never witnessed before.">
	<?php elseif ($industryDetails['name'] == "Enterprise"): ?>
	<meta name="description" content="IO by HFCL delivers a holistic network solution to meet the ever-growing bandwidth demands of rapidly progressing enterprises">
    <?php elseif ($industryDetails['name'] == "Retail"): ?>
	<meta name="description" content="IO by HFCL deploys class-leading Wi-Fi solutions enhancing the overall retail experience of shoppers leading to better customer retention">
	<?php elseif ($industryDetails['name'] == "CCTV"): ?>
	<meta name="description" content="Revolutionizing the mechanism of smart cities, factories, offices , public places and homes, IO by HFCL offer advanced solutions that capture vast amounts of unstructured video data">
	<?php elseif ($industryDetails['name'] == "IIoT"): ?>
	<meta name="description" content="IO by HFCL enables enterprises to gather actionable insights automating industrial Wi-Fi infrastructure for better business efficiency">


    <?php else: ?>
	<meta name="description" content="IO by HFCL enables reliable connection- whether in business, education, defence, or public Wi-Fi, improvising how people connect every day. ">
    <?php endif; ?>
	<?php include("include/header-link.php");?>

</head>

<body class="innerpage industrydetails">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">
			<img src="<?php echo $bannerImage; ?>" alt="industrybanner" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $industryDetails['name']; ?></h1>
					<p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $industryDetails['banner_description']; ?></p>
				</div>
			</div>
		</section>

			<section class="breadcrumb-section">

				<div class="container p0">

					<ul class="breadcrumb-in">

						<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL;?>">Home</a></li>

						<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL;?>/industries">Industries</a></li>

						<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);"><?php echo $industryDetails['name']; ?></a></li>

					</ul>

				</div>

			</section>

			<div class="backpage">

				<div class="container p0">

					<a href="<?php echo BASE_URL; ?>/industries"><span>Back to Industries Page</span></a>

				</div>

			</div>



		<section class="industrybanner-section ">
			<img src="<?php echo $image_name; ?>" alt="indelbanner" class="indimg">
			<div class="industrybannertext">
				<h1 class="wow fadeIn" data-wow-delay="0.5s"><?php echo $industryDetails['image_title']; ?></h1>
			</div>
		</section>

		

		<section class="middletext-section wow fadeIn" data-wow-delay="0.2s">
			<div class="container p0">
				<div class="middletext-in">
					<p><?php echo $industryDetails['description']; ?></p>
				</div>
			</div>
		</section>

		<section class="indrow-section">
			<div class="container p0">
				<div class="indrow-in">
					<?php if(!empty($industryDetails['detail_image1'])){ ?>
					<div class="indrowbox wow fadeIn" data-wow-delay="0.2s">
						<div class="indrowimg">
							<img src="<?php echo $detail_image1; ?>" alt="row1" loading="lazy">
						</div>
						<div class="indrowtext">
							<?php echo $industryDetails['detail_description1']; ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!empty($industryDetails['detail_image2'])){ ?>
					<div class="indrowbox wow fadeIn" data-wow-delay="0.25s">
						<div class="indrowimg">
							<img src="<?php echo $detail_image2; ?>" alt="row2" loading="lazy">
						</div>
						<div class="indrowtext">
							<?php echo $industryDetails['detail_description2']; ?>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</section>

		<?php 
			$sql = "select * from ".PREFIX."class_lead_master where active='1' AND industry_id='".$industryDetails['id']."' ORDER BY display_order ASC ";
			$query = $functions->query($sql);
			if($functions->num_rows($query)>0){
		?>
				<section class="hasslefree-section">
					<div class="container p0">
						<div class="hasslefree-in">
							<div class="headinglinebox wow fadeInUp" data-wow-delay="0.2s">
								<h2>Class-leading tech for hassle-free operations</h2>
							</div>
							<div class="hassleflex">
							<?php 
								while($leadDetails = $functions->fetch($query)){
									$leadImage = $functions->getImageUrl('industry', $leadDetails['image_name'], 'crop', '');
							?>
									<div class="hasslesub match wow fadeInUp" data-wow-delay="0.3s">
										<div class="hassleicon">
											<img src="<?php echo $leadImage; ?>" alt="<?php echo $leadDetails['title']; ?>" loading="lazy">
										</div>
										<h5><?php echo $leadDetails['title']; ?></h5>
										<p><?php echo $leadDetails['description']; ?></p>
									</div>
							<?php } ?>
							</div>
						</div>
					</div>
				</section>
		<?php } ?>





		<?php 
			$sql = "select * from ".PREFIX."class_lead_master_2 where active='1' AND industry_id='".$industryDetails['id']."' ORDER BY display_order ASC ";
			$query = $functions->query($sql);
			if($functions->num_rows($query)>0){
		?>
		<section class="imageindustry-grid" style="display: block;">
			<div class="container p0">
				<div class="c48-out-container">
				<?php 
				$x = 0;
								while($leadDetails = $functions->fetch($query)){
									$leadImage = $functions->getImageUrl('industry', $leadDetails['image_name'], 'crop', '');
							?>
							
							<?php if ($x == 0 ) { ?>
								<picture>
					  <img class="image bk-image0" src="<?php echo $leadImage; ?>" alt="<?php echo $leadDetails['title']; ?>" loading="lazy" style="opacity: 1;">
					</picture>
<?php } else { ?>
	<picture>
					  <img class="image bk-image0" src="<?php echo $leadImage; ?>" alt="<?php echo $leadDetails['title']; ?>" loading="lazy" style="display: none;">
					</picture>
					
					<?php } ?>

					<div class="lazyboxx c48-In-container<?php echo $x; ?>">
						<span></span>
						<h2 class="c48FrontLbl"><?php echo $leadDetails['title']; ?></h2>
					</div>
					<?php $x++;} ?>
					
				</div>
			</div>
		</section>
		<?php } ?>













		<section class="commoncontact-section">

			<div class="container p0">

				<div class="commoncontact-in">

					<?php include('commoncontact.php');?>

				</div>

			</div>

		</section>



	</main>



	<?php include("include/footer.php");?> 

	<?php include("include/footer-link.php");?>



	<script type="text/javascript">

		$(".checkbox-dropdown").click(function () {

		    $(this).toggleClass("is-active");

		    $('.checkbox-dropdown-list').slideToggle();

		});



		$(".checkbox-dropdown ul").click(function(e) {

		    e.stopPropagation();

		});



		$(".c48-In-container0").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image0").toggleClass("showimg");
	   });

	   $(".c48-In-container1").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image1").toggleClass("showimg");
		   $(".bk-image0").toggleClass("hideimg");
	   });

	   $(".c48-In-container2").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image2").toggleClass("showimg");
		   $(".bk-image0").toggleClass("hideimg");
	   });

	   $(".c48-In-container4").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image4").toggleClass("showimg");
		   $(".bk-image0").toggleClass("hideimg");
	   });

	   $(".c48-In-container5").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image5").toggleClass("showimg");
		   $(".bk-image0").toggleClass("hideimg");
	   });

	   $(".c48-In-container6").hover(function () {
			$(this).toggleClass("innr-ovrlyshow");
		   $(".bk-image6").toggleClass("showimg");
		   $(".bk-image0").toggleClass("hideimg");
	   });

	   $(".c48-out-container").hover(function () {
		   $(this).toggleClass("innr-ovrlyhide");
	   });



	</script>

</body>

</html>