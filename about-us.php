<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $aboutCMS = $functions->getAboutCMS();
   $bannerImage = $functions->getImageUrl('about-us', $aboutCMS['banner_image'], 'crop', '');
   $image_name = $functions->getImageUrl('about-us', $aboutCMS['image_name'], 'crop', '');
   $mid_image = $functions->getImageUrl('about-us', $aboutCMS['mid_image'], 'crop', '');
   $image_name1 = $functions->getImageUrl('about-us', $aboutCMS['image_name1'], 'crop', '');
   $image_name2 = $functions->getImageUrl('about-us', $aboutCMS['image_name2'], 'crop', '');
?>


<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || About Us </title>

	<?php include("include/header-link.php");?>

</head>

<body class="innerpage aboutus">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">

			<img src="<?php echo $bannerImage; ?>" alt="procat" class="inbanner">

			<div class="inbantext">

				<div class="container p0">

					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $aboutCMS['banner_title']; ?></h1>

					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $aboutCMS['banner_description']; ?></p>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">About Us</a></li>

				</ul>

			</div>

		</section>

		<section class="aboutus-section" id="aboutio">

			<div class="container p0">

				<div class="aboutus-in">

					<div class="aboutus-img match wow fadeInUp" data-wow-delay="0.5s">

						<img src="<?php echo $image_name; ?>" alt="aboutus" loading="lazy">

					</div>

					<div class="aboutus-text match wow fadeInUp" data-wow-delay="0.55s">

						<div class="scrollbox">

							<?php echo $aboutCMS['description']; ?>

						</div>

					</div>

				</div>

			</div>

		</section>



		<section class="middleimg-section">

			<img src="<?php echo $mid_image; ?>" alt="aboutmiddle">

		</section>

		<section class="aboutus-section hfclsection" id="abouthfcl">

			<div class="container p0">

				<div class="aboutus-in">

					<div class="aboutus-img match wow fadeInUp" data-wow-delay="0.5s">

						<img src="<?php echo $image_name1; ?>" alt="hfcllogo" loading="lazy">

					</div>

					<div class="aboutus-text match wow fadeInUp" data-wow-delay="0.55s">

						<div class="scrollbox">
							<?php echo $aboutCMS['description1']; ?>

						</div>

					</div>

				</div>

			</div>

		</section>



		<section class="iostandards-section">

			<img src="images/iostandards.png" alt="iostandards" loading="lazy" class="iostandardsbg">

			<div class="iostandardsbox">

				<div class="container p0">

					<div class="iostandards-in">

						<div class="iostandards-img wow fadeInUp" data-wow-delay="0.5s">

							<img src="<?php echo $image_name2; ?>" alt="io" loading="lazy">

						</div>

						<div class="iostandards-text wow fadeInUp" data-wow-delay="0.5s">

							<?php echo $aboutCMS['description2']; ?>

						</div>

					</div>

				</div>

			</div>

		</section>



		<section class="ourpeoplespeckes-section">

			<div class="container p0">

				<div class="ourpeoplespeckes-in">

					<h2 class="wow fadeInUp" data-wow-delay="0.5s">Our People Speak</h2>



					<div class="peoplespeks-slider thinslicksliderarrow">
						<?php 
							$testimonial = $functions->getAllActiveTestimonial();
							while($testimonialDetails = $functions->fetch($testimonial)){
								$testimonialImage = $functions->getImageUrl('testimonial', $testimonialDetails['image_name'], 'crop', '');
						?>
							<div class="peoplespeks-slide match">
								<div class="speakesflexx">
									<div class="speakerimg">
										<img src="<?php echo $testimonialImage; ?>" alt="speaker_1" loading="lazy">
									</div>
									<div class="speaker-cooment">
										<div class="tc">
											<p>"<?php echo $testimonialDetails['description']; ?>"</p>
										</div>
										<div class="bd">
											<h5><?php echo $testimonialDetails['name']; ?></h5> 
											<h6>- <?php echo $testimonialDetails['designation']; ?></h6>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>



				</div>

			</div>

		</section>



		<section class="corporatevideo-section">

			<div class="container p0">

				<div class="corporatevideo-in">

					<h2 class="wow fadeInUp" data-wow-delay="0.5s">IO Networks Corporate Video</h2>



					<div class='cover'> 
					 	<video controls class = 'video' width = '600'>
					        <source src="images/videos/<?php echo $aboutCMS['corporate_video']; ?>" type="video/mp4" />

					        <!-- <source src="https://riverisland.scene7.com/is/content/RiverIsland/c20171205_Original_Penguin_AW17_Video_OGG" /> -->
					        <img src=" fall-back image" alt="">
					    </video> 

					</div>

	

				</div>

			</div>

		</section>



	</main>

	<?php include("include/footer.php");?> 

	<?php include("include/footer-link.php");?>

	<script type="text/javascript">

		$('.cover').on('click', function () {

		    $(this).children().css({

		      'z-index' : 1,

		      'opacity': 1

		    });

		  $(this).children().trigger('play');

		     

		});



		$('video').on('click', function () {

		  console.log('a');

		});







        if ($(window).width() < 800) {

               <?php

                  if(isset($_GET['action'])){

                  ?>               

                     $('html, body').animate({scrollTop: $( '#<?php echo $_GET['action']; ?>' ).offset().top - 200}, 500);

                    <?php

                     }

               ?>

             }

             if ($(window).width() > 800) {

               <?php

                  if(isset($_GET['action'])){

                  ?>               

                     $('html, body').animate({scrollTop: $( '#<?php echo $_GET['action']; ?>' ).offset().top - 120}, 500);

                     <?php

                     }

               ?>

             }

	</script>

</body>

</html>