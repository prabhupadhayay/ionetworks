<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $sql ="select * from ".PREFIX."industry_listing_cms ";
   $query = $functions->query($sql);
   $industryCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $industryCMS['image_name'], 'crop', '');

?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || Industry </title>
	<meta name="description" content="IO by HFCL enables reliable connection- whether in business, education, defence, or public Wi-Fi, improvising how people connect every day.">
	<?php include("include/header-link.php");?>

</head>

<body class="innerpage industry">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">

			<img src="<?php echo $bannerImageData; ?>" alt="industrybanner" class="inbanner">
			<div class="inbantext">

				<div class="container p0">

					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $industryCMS['title']; ?></h1>

					<p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $industryCMS['description']; ?></p>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Industries</a></li>

				</ul>

			</div>

		</section>

		

		<section class="industrylist-section">
			<div class="container p0">
				<div class="industrylist-in">
					<div class="checkbox-dropdown">
						 	Choose Industry
						<ul class="checkbox-dropdown-list">
						<?php
							$industryList = $functions->getAllActiveIndustry();
							$abc = 1;
							while($inds = $functions->fetch($industryList)){
						?>
						   	<li>
						       	<input type="checkbox" class="industryType" value="<?php echo $inds['id']; ?>" name="industryType" id="ind<?php echo $abc; ?>"/>
						      	<label for="ind<?php echo $abc; ?>"><?php echo $inds['name']; ?></label>
						   	</li>
						<?php $abc++; } ?>
						</ul>
					</div>

					



					<div class="indusrylisting">

					<?php 
						$sqlIndustry ="select * from ".PREFIX."industry_master where active='1' ORDER BY display_order ASC ";
						$queryIndustry = $functions->query($sqlIndustry);
						while($industryDetails = $functions->fetch($queryIndustry)){
							$industryImage = $functions->getImageUrl('industry', $industryDetails['listing_image'], 'crop', '');
					?>
						<div class="indusrylistrow wow fadeInUp" data-wow-delay="0.5s">
							<div class="indusrythumb">
								<img src="<?php echo $industryImage; ?>" alt="<?php echo $industryDetails['name']; ?>" loading="lazy">
							</div>
							<div class="indusrytext">
								<h2><?php echo $industryDetails['name']; ?></h2>
								<p><?php echo $industryDetails['short_description']; ?></p>
								<a href="<?php echo BASE_URL; ?>/industries/<?php echo $industryDetails['permalink']; ?>" class="knowbtn">Know More</a>
							</div>
						</div>
					<?php } ?>




					</div>
				</div>
			</div>
		</section>



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
		$(document).ready(function(){
			$(document).on("change", ".industryType", function() {
				filterFunction();
			});
		});

		function filterFunction(){
			var industryIds = [];
			$(".industryType").each(function(){
				if($(this).prop("checked") == true) {
					industryIds.push($(this).val());
				}
			});

			$.ajax({
				url:"<?php echo BASE_URL; ?>/ajax-filter-industry-list.php",
				data:{
					industryIds: industryIds,
				},
				type:"POST",
				success: function(response){
					$('.indusrylisting').html(response);
				},
				error: function(){
					console.log("Unable to load data, please try again");
				},
				complete: function(response){
					MatchHeight1();
				}
			});
		}
	</script>



	<script type="text/javascript">
		$('.checkbox-dropdown').on("click", function(event)
		  {
		   $(this).toggleClass('is-active');
		    $('.checkbox-dropdown-list').slideToggle();
		      event.stopPropagation();
		  });

		  $('.checkbox-dropdown, .checkbox-dropdown-list').on("click", function(event)
		  {
		      event.stopPropagation();
		  });

		  $(document).on("click", function(event)
		  {
		    $('.checkbox-dropdown').removeClass('is-active');
		    $('.checkbox-dropdown-list').slideUp();
		 });
	</script>
</body>
</html>