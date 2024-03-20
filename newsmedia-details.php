<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   if(isset($_GET['permalink']) && !empty($_GET['permalink'])){
   		$permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
   		$mediaDetails = $functions->getMediaDetailsByPermalink($permalink);
   		$detail_image = $functions->getImageUrl('media', $mediaDetails['detail_image'], 'crop', '');
   }else{
   	header("location: ".BASE_URL."/news&media");
		exit();
   }

   $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || News & Media Details </title>

	<?php include("include/header-link.php");?>

</head>

<body class="innerpage newsmediadetailspagr">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="breadcrumb-section mtop">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/news&media/<?php echo $mediaDetails['type']; ?>">News & Media</a></li>
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);"><?php echo $mediaDetails['title']; ?></a></li>

				</ul>

			</div>

		</section>

		

		<section class="article-section">

			<div class="container p0">

				<div class="article-in">



					<div class="backpage">

						<a href="<?php echo BASE_URL; ?>/news&media/<?php echo $mediaDetails['type']; ?>"><span>Back to News & Media</span></a>

					</div>



					<div class="newsandmediabox-article">



						<h2><?php echo $mediaDetails['title']; ?></h2>



						<div class="newsandmediabox-articleflex">

							<div class="newsandmediabox-articleimg">

								<img src="<?php echo $detail_image; ?>" alt="ver-img" loading="lazy">

							</div>

							<div class="newsandmediabox-articletext">

								<p><?php echo date("F j, Y", strtotime($mediaDetails['media_date'])); ?></p>



								<?php echo $mediaDetails['description']; ?>


								<?php 

								?>
								<div class="backpage">
									<a href="<?php echo $functions->getRandomMediaByType($mediaDetails['type']); ?>"><span>Next</span></a>
								</div>

								<div class="blogwidgetsbox">

									<div class="blogwidgethead">

										<h4>Share</h4>

									</div>

									<div class="blogwidgebottom">

										<div class="blogsocial">
										<?php /* if(!empty($mediaDetails['facebook'])){ ?>
											<a href="<?php echo $mediaDetails['facebook']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/fb.png"></a>
										<?php } if(!empty($mediaDetails['instagram'])){ ?>

											<a href="<?php echo $mediaDetails['instagram']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/insta.png"></a>
										<?php } if(!empty($mediaDetails['twitter'])){ ?>

											<a href="<?php echo $mediaDetails['twitter']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/tw.png"></a>
										<?php } if(!empty($mediaDetails['youtube'])){ ?>

											<a href="<?php echo $mediaDetails['youtube']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/yt.png"></a>
										<?php } if(!empty($mediaDetails['linkedin'])){ ?>

											<a href="<?php echo $mediaDetails['linkedin']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/linkedin.png"></a>
										<?php } */?>


											<a href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode($actual_link)?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/fb.png"></a>

											<!-- <a href="https://www.instagram.com/" target="_blank"><img src="<?php //echo BASE_URL; ?>/images/social/insta.png"></a> -->

											<a href="https://twitter.com/intent/tweet?url=<?=urlencode($actual_link)?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/tw.png"></a>

											<!-- <a href="https://www.youtube.com/" target="_blank"><img src="<?php //echo BASE_URL; ?>/images/social/yt.png"></a> -->

											<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode($actual_link)?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/linkedin.png"></a>
										</div>

									</div>

								</div>



							</div>

						</div>



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





	</script>

</body>

</html>