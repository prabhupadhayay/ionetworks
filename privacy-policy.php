<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $cmsDetails = $functions->gerCMSDetailsByPageName('privacy_policy');
   $bannerImage = $functions->getImageUrl('slider-banner', $cmsDetails['image_name'], 'crop', '');
?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || Privacy Policy </title>

	<?php include("include/header-link.php");?>

</head>

<body class="innerpage contentpages">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">

			<img src="<?php echo $bannerImage; ?>" alt="procat" class="inbanner">

			<div class="inbantext">

				<div class="container p0">

					<h1 class="wow fadeInUp" data-wow-delay="0.5s">Privacy Policy</h1>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Privacy Policy</a></li>

				</ul>

			</div>

		</section>



		<section class="contentpage-section">
			<div class="container p0">
				<div class="contentpage-in wow fadeIn" data-wow-delay="0.5s">
					<?php echo $cmsDetails['description']; ?>
				</div>
			</div>
		</section>
	</main>

	<?php include("include/footer.php");?> 

	<?php include("include/footer-link.php");?>

	<script type="text/javascript">

	</script>

</body>

</html>