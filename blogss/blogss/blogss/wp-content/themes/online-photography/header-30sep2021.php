<?php

/**

 * The header for our theme

 *

 * This is the template that displays all of the <head> section and everything up until <div id="content">

 *

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 *

 * @package online_photography

 */



?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">




	<?php wp_head(); ?>

</head>



<body <?php body_class('innerpage'); ?>>



<?php do_action( 'wp_body_open' ); ?>



<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'online-photography' ); ?></a>



	<?php if( is_front_page() || !is_paged() ) {

		get_template_part( 'inc/header', 'image' );

	} ?>

<!-- Loader start -->

<div id="loader-wrapper">

	<div class="loader">            

		<img src="<?php echo get_template_directory_uri(); ?>/images/logo_final_1.png">

	</div>

</div>

<!-- Loader end -->

<div class="wrapper">	

 <header class="header">

 	<div class="tophead">

 		<div class="container p0">

 			<div class="topheadflex">

	 			<a href="https://shareittofriends.com/demo/ionetworks-php/contact-us.php" class="anchorcontact <?php if($currentPage=='contact-us.php') { echo 'active'; }?>">Contact Us</a>

	 			<a href="#">Partner Login</a>

	 			<a href="javascript:void(0)" class="searchclick"><i class="fa fa-search" aria-hidden="true"></i></a>

	 		</div>

 		</div>

 		<div class="searchbar">

 			<form class="search">

 				<div class="form-group">

 					<input type="text" name="serach" class="form-control" placeholder="Search..">

 				</div>

	 			<div class="closesearch">

	 				<i class="fa fa-times" aria-hidden="true"></i>

	 			</div>

 			</form>

 		</div>

 	</div>

 	<div class="bottommenu">

 		<div class="container p0">

 			<div class="bottommenuflex">

 				<div class="logo">

 					<a href="https://shareittofriends.com/demo/ionetworks-php/index.php">

 						<img src="<?php echo get_template_directory_uri(); ?>/images/logo_final_1.png" alt="logo" loading="lazy">

 					</a>

 				</div>

 				<div class="mainmenu">

 					<ul>

 						<li class="menuhover">

 							<a href="javascript:void(0);">Product</a>

 							<div class="dropmenu">

 								<div class="dropmenuin">

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/wifi.png" alt="logo" loading="lazy">

	 										</div>

	 										<h4>Wi-Fi</h4>

 										</div>

 										<ul>

 											<li><a href="https://shareittofriends.com/demo/ionetworks-php/product-access-point.php">Access Points</a></li>

 										</ul>

 									</div>

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/switches.png" alt="switches" loading="lazy">

	 										</div>

	 										<h4>SWITCHES</h4>

 										</div>

 										<ul>

 											<li><a href="#">PoE</a></li>

 											<li><a href="#">Non-PoE</a></li>

 										</ul>

 									</div>

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/ubr.png" alt="ubr" loading="lazy">

	 										</div>

	 										<h4>UBR</h4>

 										</div>

 									</div>

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/managesol.png" alt="managesol" loading="lazy">

	 										</div>

	 										<h4>MANAGEMENT SOLUTIONS</h4>

 										</div>

 										<ul>

 											<li><a href="#">cNMS</a></li>

 											<li><a href="#">EMS</a></li>

 										</ul>

 									</div>

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/accessories.png" alt="accessories" loading="lazy">

	 										</div>

	 										<h4>ACCESSORIES</h4>

 										</div>

 										<ul>

 											<li><a href="#">Power Solutions AC/DC Adaptors</a></li>

 											<li><a href="#">Antenna</a></li>

 											<li><a href="#">Solar Aggregation</a></li>

 										</ul>

 									</div>

 								</div>

 							</div>

 						</li>

 						<li class="menuhover <?php if($currentPage=='https://shareittofriends.com/demo/ionetworks-php/industry.php') { echo 'active'; }?>">

 							<a href="https://shareittofriends.com/demo/ionetworks-php/industry.php">Industry</a>

 							<div class="dropmenu inddrop">

 								<div class="dropmenuin">

 									<ul class="indmenul">

 										<!-- <li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php //echo get_template_directory_uri(); ?>/images/dropdown/government.png" alt="government" loading="lazy">

	 											<span>Government</span>

	 										</a>

 										</li> -->

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/tcp.png" alt="tcp" loading="lazy">

 											<span>TSP /ISP</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/enterprice.png" alt="enterprice" loading="lazy">

 											<span>Enterprise</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/retail.png" alt="retail" loading="lazy">

 											<span>Retail</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/home.png" alt="home" loading="lazy">

 											<span>Home</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/hospitality.png" alt="hospitality" loading="lazy">

 											<span>Hospitality</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/healthcare.png" alt="healthcare" loading="lazy">

 											<span>Healthcare</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/education.png" alt="education" loading="lazy">

 											<span>Education</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/smallbus.png" alt="smallbus" loading="lazy">

 											<span>Small & Medium Businesses</span>

	 										</a>

 										</li>

 										<li class="match">

 											<a href="https://shareittofriends.com/demo/ionetworks-php/industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/publicwifi.png" alt="publicwifi" loading="lazy">

 											<span>Public Wi-Fi</span>

	 										</a>

 										</li>

 										<li class="match">
 											<a href="industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/cctv.png" alt="cctv" loading="lazy">
 											<span>CCTV</span>
	 										</a>
 										</li>

 										<li class="match">
 											<a href="industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/iiot.png" alt="iiot" loading="lazy">
 											<span>IIOT</span>
	 										</a>
 										</li>

 										<li class="match">
 											<a href="industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/defence.png" alt="defence" loading="lazy">
 											<span>Defence</span>
	 										</a>
 										</li>

 										<li class="match">
 											<a href="industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/mining.png" alt="mining" loading="lazy">
 											<span>Mining</span>
	 										</a>
 										</li>

 										<li class="match">
 											<a href="industry-details.php"><img src="<?php echo get_template_directory_uri(); ?>/images/dropdown/rural_braodband.png" alt="rural_braodband" loading="lazy">
 											<span>Rural Broadband</span>
	 										</a>
 										</li>



 									</ul>

 								</div>

 							</div>

 						</li>

 						<li class="menuhover">

 							<a href="javascript:void(0);">Resources</a>

 							<div class="dropmenu resourcesdrop">

 								<div class="dropmenuin">

 									<div class="dropsub">

 										<div class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/explore.png" alt="explore" loading="lazy">

	 										</div>

	 										<h4>Explore</h4>

 										</div>

 										<ul>

 											<li><a href="https://shareittofriends.com/demo/ionetworks-php/blogs.php">Blogs</a></li>

 											<li><a href="#">Documentation</a></li>

 										</ul>

 									</div>

 									<div class="dropsub">

 										<a href="https://shareittofriends.com/demo/ionetworks-php/news-media.php" class="drophead">

 											<div class="dropicon">

	 											<img src="<?php echo get_template_directory_uri(); ?>/images/media.png" alt="media" loading="lazy">

	 										</div>

	 										<h4>News & Media</h4>

 										</a>

 										<ul>

 											<li><a href="https://shareittofriends.com/demo/ionetworks-php/news-media.php?action=PressRelease">Press Releases</a></li>

 											<li><a href="https://shareittofriends.com/demo/ionetworks-php/news-media.php?action=Events">Events</a></li>

 										</ul>

 									</div>

 								</div>

 							</div>

 						</li>

 						<li class="menuhover">

 							<a href="javascript:void(0);">Partner</a>

 							<div class="dropmenu partnerdrop">

 								<div class="dropmenuin">

 									<ul class="indmenul partul">

 										<li>

 											<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/portal.png" alt="portal" loading="lazy">

	 											<span>Partner Portal Login</span>

	 										</a>

 										</li>

 										<li>

 											<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/member.png" alt="member" loading="lazy">

 											<span>Become a Partner</span>

	 										</a>

 										</li>

 									</ul>

 								</div>

 							</div>

 						</li>

 					</ul>

 					<a href="#" class="getdemobtn">Get a demo</a>

 				</div>

 			</div>

 		</div>

 	</div>

 </header>



      

	 





	<div id="content" class="site-content">

		



