<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
 	include("include/php-variables.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || Sitemap </title>
	<?php include("include/header-link.php");?>
</head>
<body class="innerpage ">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo BASE_URL;?>/images/sitemap_banner.jpg" alt="sitmapbanner" class="inbanner">
			<img src="images/catbanimg.png" alt="catbanimg" class="cenbanimg">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s">Sitemap</h1>
					<p class="wow fadeInUp" data-wow-delay="0.55s">All the information you need in one place</p>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Sitemap</a></li>
				</ul>
			</div>
		</section>
		<section class="sitemap-section">
			<div class="container p0">
				<div class="sitemap-in">

					<div class="sitemaplist">
						<div class="sitemapsub">
							<div class="sitemaphead">
								<h3><a href="<?php echo BASE_URL;?>/industries">Industry</a></h3>
							</div>
							<ul>
								<li><a href="<?php echo BASE_URL;?>/industries/tsp-isp">TSP/ISP</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/hospitality">Hospitality</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/education-">Education</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/healthcare">Healthcare</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/smart-home">Smart Home</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/public-wi-fi">Public Wi-Fi</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/public-hotspots">Public Hotspots</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/mining">Mining</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/defense">Defence</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/small-medium-businesses">Small & Medium Businesses</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/enterprise">Enterprise</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/retail">Retail</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/cctv">CCTV</a></li>
								<li><a href="<?php echo BASE_URL;?>/industries/tsp-isp">IIOT</a></li>
							</ul>
						</div>
						<div class="sitemapsub big">
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3><a href="<?php echo BASE_URL;?>/products">Product</a></h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/category/access-points">Wi-Fi</a></li>
									<li><a href="<?php echo BASE_URL;?>/category/commercial-access-switch">Managed Switches</a></li>
									<li><a href="<?php echo BASE_URL;?>/category/p2p-">UBR</a></li>
									<li><a href="<?php echo BASE_URL;?>/cnms">Cloud Networking Platforms</a></li>
									<li><a href="<?php echo BASE_URL;?>/category/antennas">Accessories</a></li>
								</ul>
							</div>
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3>Resource</h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/blogs">Blogs</a></li>
									<li><a href="<?php echo BASE_URL;?>/documentation">Documentation</a></li>
								</ul>
							</div>
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3>Partner</h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/partner">Partner Portal Login</a></li>
									<li><a href="<?php echo BASE_URL;?>/partner">Become a Partner</a></li>
								</ul>
							</div>
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3>News & Media</h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/news&media/PressRelease">Press Releases</a></li>
									<li><a href="<?php echo BASE_URL;?>/news&media/Events">Events</a></li>
								</ul>
							</div>
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3>Footer</h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/privacy-policy">Privacy policy</a></li>
									<li><a href="<?php echo BASE_URL;?>/terms-of-service">Terms of service</a></li>
									<li><a href="#">Legal</a></li>
								</ul>
							</div>
							<div class="sitemapsubb">
								<div class="sitemaphead">
									<h3>Contact us</h3>
								</div>
								<ul>
									<li><a href="<?php echo BASE_URL;?>/contact-us?action=indassociates">Industry associations</a></li>
									<li><a href="<?php echo BASE_URL;?>/contact-us?action=locations">Office location</a></li>
								</ul>
							</div>
						</div>
					</div>

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