<?php

/**

 * The main template file

 *

 * This is the most generic template file in a WordPress theme

 * and one of the two required files for a theme (the other being style.css).

 * It is used to display a page when nothing more specific matches a query.

 * E.g., it puts together the home page when no home.php file exists.

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package online_photography

 */



get_header();

?>



<main class="root">
		
		<?php include("include/header.php");?>

		<!-- breadcrumb_area start -->
        <div class="breadcrumb_area">
            <div class="container">
                <div class="breadcumb_cnt">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li>Blogs</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb_area end -->

		<section class="blog-area">
            <div class="container">
                <div class="blog-upper">
                    <h1>Latest Blogs: Regular Insights on Access Solutions</h1>
                    <p>Dive into up-to-the-minute reflections, opinions, and analyses from our team of experts.</p>
                </div>
                <div class="blog_main d-none d-md-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="https://io.hfcl.com/blog/wired-to-win-an-ultimate-guide-to-poe-switches/">
                                <div class="blog_left">
                                    <div class="imghover-effect"><img src="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-for-Blog-PoE-Switches.jpg" alt="PoE Switch"></div>
                                    <div class="blog-cnt blog-cntleft">
                                        <span class="date-fix">September 20, 2023</span>
                                        <p>Wired to Win: An Ultimate Guide to PoE Switches</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog_right">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <a href="https://io.hfcl.com/blog/ont-devices-bridging-the-gap-to-ultra-fast-internet/">
                                            <div class="blog-item">
                                                <div class="imghover-effect"><img src="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-ONT-Device-Blog.jpg" alt="What is an ONT Device?"></div>
                                                <div class="blog-cnt">
                                                    <span class="date-fix">September 5, 2023</span>
                                                    <p>ONT Devices: Bridging the Gap to Ultra-Fast Internet</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <a href="https://io.hfcl.com/blog/what-is-ont/">
                                            <div class="blog_left">
                                                <div class="imghover-effect"><img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/ONT-Banner-Image.png" alt="Exploring ONT"></div>
                                                <div class="blog-cnt blog-cntleft">
                                                    <span class="date-fix">August 17, 2023</span>
                                                    <p>Exploring ONT: The Cornerstone of Modern Optical Networking</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <a href="https://io.hfcl.com/blog/best-place-to-put-wi-fi-router/">
                                            <div class="blog-item">
                                                <div class="imghover-effect"><img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/Artboard-1-copy-2.png" alt="Best Spot to Place Wi-Fi Router"></div>
                                                <div class="blog-cnt">
                                                    <span class="date-fix">August 11, 2023</span>
                                                   <p>How To Position Your Wi-Fi Router For Optimal Performance?</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <a href="https://io.hfcl.com/blog/fueling-progress-in-the-oil-and-gas-industry-with-wireless-network-solutions/">
                                            <div class="blog-item">
                                                <div class="imghover-effect"><img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/MicrosoftTeams-image-7.png" alt="Wireless Network Solutions for Oil and Gas Industry"></div>
                                                <div class="blog-cnt">
                                                    <span class="date-fix">August 8, 2023</span>
                                                   <p>Fueling Progress in the Oil and Gas Industry with Wireless Network Solutions</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog_main d-md-none">
                    <div class="owl-carousel owl-csel1">
                        <div>
                            <a href="https://io.hfcl.com/blog/wired-to-win-an-ultimate-guide-to-poe-switches/">
                                <div class="blog_left">
                                    <img src="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-for-Blog-PoE-Switches.jpg" alt="PoE Switch">
                                    <div class="blog-cnt blog-cntleft">
                                        <span class="date-fix">September 20, 2023</span>
                                        <p>Wired to Win: An Ultimate Guide to PoE Switches</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="https://io.hfcl.com/blog/what-is-ont/">
                                <div class="blog_left">
                                    <img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/ONT-Banner-Image.png" alt="Exploring ONT">
                                    <div class="blog-cnt blog-cntleft">
                                        <span class="date-fix">September 5, 2023</span>
                                        <p>Exploring ONT: The Cornerstone of Modern Optical Networking</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="https://io.hfcl.com/blog/what-is-ont/">
                                <div class="blog_left">
                                    <img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/ONT-Banner-Image.png" alt="Exploring ONT">
                                    <div class="blog-cnt blog-cntleft">
                                        <span class="date-fix">August 17, 2023</span>
                                        <p>Exploring ONT: The Cornerstone of Modern Optical Networking</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="https://io.hfcl.com/blog/best-place-to-put-wi-fi-router/">
                                <div class="blog-item">
                                    <img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/Artboard-1-copy-2.png" alt="Best Spot to Place Wi-Fi Router">
                                    <div class="blog-cnt">
                                        <span class="date-fix">August 11, 2023</span>
                                       <p>How To Position Your Wi-Fi Router For Optimal Performance?</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="https://io.hfcl.com/blog/fueling-progress-in-the-oil-and-gas-industry-with-wireless-network-solutions/">
                                <div class="blog-item">
                                    <img src="https://io.hfcl.com/blog/wp-content/uploads/2023/08/MicrosoftTeams-image-7.png" alt="Wireless Network Solutions for Oil and Gas Industry">
                                    <div class="blog-cnt">
                                        <span class="date-fix">August 8, 2023</span>
                                       <p>Fueling Progress in the Oil and Gas Industry with Wireless Network Solutions</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		<section class="tab-area">
            <div class="container">
                <div class="tab-upper">
                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                        <a class="nav-link active" id ="allBlogs" href="javascript:void(0)">All</a>
                        <a class="nav-link" id ="productBlogs" href="javascript:void(0)">Product</a>
                        <a class="nav-link" id ="learningBlogs" href="javascript:void(0)">Industry</a>
                        <a class="nav-link" id ="techBlogs" href="javascript:void(0)">Tech</a>
                        <a class="nav-link" id ="solutionBlogs" href="javascript:void(0)">Solution</a>
                    </div>
                    <form class="serachblogform">
                        <div class="form-group search_bar">
                            <!-- <input type="text" id="blog2search"  name="s" class="form-control" placeholder="Search..." required> -->
                            <input type="text" class="form-control" placeholder="Search..." name="">
                        </div>
                    </form>
                </div>
            </div>
        </section>

		<section class="blogpage-section">
			<div class="container p0">
				<div class="blogpage-in">


			

					<?php $s = ''; if(isset($_GET['s'])){ $s = $_GET['s']; ?>

<span id="noResult"><h5>Search Results for <b>"<?php echo $s; ?>"</b><a href="/blogs"> <i class="fa fa-close" aria-hidden="true"></i> Close</a> </h5></span>
					<?php } ?>

					<div class="row">
						<div class="col-lg-9">
                            <div class="row blogerlists">
			                      <?php 
			                        include_once('blog/wp-load.php');
			                         $recent_posts = wp_get_recent_posts(array(
			                           'numberposts' =>20
			                         ));

							//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$paged = 1;
							// $s=get_search_query();


							$args = array(

							's' =>$s,

							'post_type' => 'post',

							'post_status' => 'publish',

							'posts_per_page' => 20,

							'paged' => $paged

							);

							$search_posts = new WP_Query($args);
						
				// print_r($search_posts);
				// 			echo $search_posts->have_posts();
				// exit();


		                      ?>
			                      <?php 
			                          $x=1;
			                          // foreach($search_posts as $key=>$post){
			                          if($search_posts->have_posts()){
			                          while($search_posts->have_posts()){
			                          	$search_posts->the_post();
			                         
			                          
			                    
			                            $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
			                            $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); 
			                            $author_id = get_post_field ('post_author', get_the_ID());
										$display_name = get_the_author_meta( 'display_name' , $author_id );
										$display_name_post = get_the_author_meta( 'description' , $author_id );
										$avatar_url  = get_avatar_url( $author_id );
										// $image_title = get_the_title( $image->id );
										$img_id = get_post_thumbnail_id(get_the_ID());
			                        ?> 
			                                    <div class="col-sm-12 col-md-6 col-lg-4 blog-boxed <?php echo get_the_ID(); ?>">
			                                    	 <div class="tab-item">
			                                    	 	<?php $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true); ?>
			                                            <div class="imghover-effect"><img src="<?php echo $feat_image; ?>" alt="<?php echo $alt_text; ?>" loading="lazy"></div>
    			                                        <div class="overly-tags">
                                                        	<ul>
                                                				<li><a href="https://io.hfcl.com/blog/tag/access-points-wi-fi-6">Access Points Wi-Fi 6</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/antenna-omnidirectional">Antenna Omnidirectional</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/cloud-management">Cloud Management</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/easymesh-coverage">EasyMesh Coverage</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/enterprise-network">Enterprise Network</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/mobile-data-offload">Mobile Data Offload</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/network-backhaul-p2mp">Network Backhaul – P2MP</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/outdoor-access-points">Outdoor Access Points</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/poe-switch">PoE Switch</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/rural-broadband">Rural Broadband</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/secure-network-wp3">Secure Network WPA3</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/ubr-point-to-point-2">UBR – Point-To-Point</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/5g-wi-fi-6">5G & Wi-Fi 6</a></li>
                                                				<li><a href="https://io.hfcl.com/blog/tag/automotive-connectivity">Automotive Connectivity</a></li>
                                                			</ul>
                                                        </div>
                                                        <div class="tab-cnt">
                                                            <span><?php echo get_the_date();?></span>
                                                            <h6><?php echo the_title(); ?></h6>
                                                            <p><?php echo substr(strip_tags(get_the_content()),0,100).'...'; ?></p>
                                                            <a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-solid btn-hover-swp border-none">
                                                                <span class="btn-txt">Read More</span>
                                                                <span class="btn-icon"><i class="fa fa-solid fa-plus"></i></span>
                                                                <span class="btn-icon"><i class="fa fa-solid fa-plus"></i></span>
                                                            </a>
                                                        </div>
			                                        </div>
			                                    </div>
			                      <?php 
			                        $x++; 
			                        }} else { ?>
			                        	<h4>No Result Found.</h4>
			                        <?php } ?>
                            </div>
							<!-- <div class="pagination_blog">
								<a href="#" class="active">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
							</div> -->
						</div>
					<div class="col-lg-3">
						<div class="tab_right">
                                <div class="feature-cnt">
                                    <h4>Featured Articles</h4>
                                    <ul>
                                        <li><a href="https://io.hfcl.com/wi-fi7-whitepaper">HFCL Empowers Connectivity Beyond Imagination (Wi-Fi 7 Whitepaper)</a></li>
                                        <li><a href="https://syndicated.wifinowglobal.com/resource/experience-the-best-in-home-connectivity-with-io-weave-home-mesh-router">Experience the best in-home connectivity with IO Weave Home Mesh Router</a></li>
                                        <li><a href="https://wballiance.com/wi-fi-sensing-connect-automate-and-operate-anywhere">Wi-Fi Sensing: Connect, Automate, and Operate Anywhere - Wireless Broadband Alliance (wballiance.com)</a></li>
                                        <li><a href="https://syndicated.wifinowglobal.com/resource/tip-open-wifi-io-reimagining-enterprise-connectivity-ecosystem">Tip Open WiFi & IO - Reimagining Enterprise Connectivity Ecosystem</a></li>
                                        <li><a href="https://www.linkedin.com/pulse/broadband-internet-shifting-banking-from-conventional-convenient-/?trackingId=%2F1XB%2Bn4X2AGvHslGDoEeZQ%3D%3D">Broadband Internet - Shifting Banking From Conventional to Convenient</a></li>
                                        <li><a href="https://wballiance.com/wi-fi-trends-in-2022-connecting-people-things-and-environment">Wi-Fi Trends in 2022- Connecting People, Things, and Environment</a></li>
                                        <li><a href="https://wballiance.com/guest-blog-public-wi-fi-the-next-giant-digital-leap-in-the-connected-world">Public Wi-Fi- The NEXT Giant Leap in the CONNECTED Future</a></li>
                                        <li><a href="https://syndicated.wifinowglobal.com/resource/wi-fi-6-penetrating-transport-ecosystem">Wi-Fi 6 Penetrating Transport Ecosystem</a></li>
                                        <li><a href="https://syndicated.wifinowglobal.com/resource/broadband-in-education-sector-bridging-digital-canyon">Broadband in Education sector- Bridging Digital Canyon</a></li>
                                        <li><a href="https://www.linkedin.com/pulse/women-tech-key-world-iobyhfcl/?trackingId=r%2Bbd7BIM1rEHTuU6HeDI3Q%3D%3D">Women in tech: A key to ''=" world</a></li>
                                        <li><a href="https://ashutosh-datta.medium.com/wi-fi-networking-redefining-the-hospitality-sector-2ece7ed59e99">Wi-Fi Networking Redefining Hospitality</a></li>
                                        <li><a href="https://wballiance.com/wi-fi-empowering-industry-revolution">Wi-Fi Empowering Industry Revolution</a></li>
                                        <li><a href="https://syndicated.wifinowglobal.com/resource/wi-fi-6e-future-of-next-gen-connectivity">Wi-Fi 6E: Future of Next-Gen Connectivity</a></li>
                                        <li><a href="https://www.linkedin.com/pulse/children-internet-navigating-endless-possibilities-wi-fi-6-/?trackingId=gEYs5MGjSJELsiHW91abmw%3D%3D">Children and Internet- Navigating Endless Possibilities with Wi-Fi6</a></li>
                                        <li><a href="https://www.guestarticlehouse.com/wireless-tech-is-revolutionizing-the-education-sector-amid-covid-beyond">Wireless Tech is Revolutionizing the Education Sector amid Covid and beyond</a></li>
                                    </ul>
                                </div>
                                <div class="feature-cnt border-0">
                                    <h4>Tags</h4>
                                    <ul>
                                        <?php
                                        $args = array(
                                                'hide_empty'       => 0,
                                               'orderby'          => 'name'
                                        );
                                      
                                        $cat_logo = z_taxonomy_image_url($term->term_id);
                                        $tags = get_tags();
                                            $category_link = '';
                                        $tags = get_tags($args);
                                           foreach($tags as $tag) {
                                        ?>
                                            <li><a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name; ?></a></li>
                                        <?php
                                           }
                                        ?>
                                    </ul>
                                </div>
                            </div>
					</div>
					</div>
				</div>
			</div>
		</section>

		<section class="imageindustry-grid" style="display: none;">
			<div class="container p0">
				<div class="c48-out-container">
					<picture>
					  <img class="image bk-image0" src="images/industry/thumblazy/video-conferencing.jpg" style="opacity: 1">
					</picture>
					<div class="lazyboxx c48-In-container0">
						<span></span>
						<h2 class="c48FrontLbl">Seamless Video Conferencing</h2>
					</div>

					<picture>
					  <img class="image bk-image1" src="images/industry/thumblazy/interactive-digital-library.jpg" style="display: none;">
					</picture>
					<div class="lazyboxx c48-In-container1">
						<h2 class="c48FrontLbl">Interactive Digital Library</h2>
					</div>

					<picture>
					  <img class="image bk-image2" src="images/industry/thumblazy/wireless-campus.jpg" style="display: none;">
					</picture>
					<div class="lazyboxx c48-In-container2">
						<h2 class="c48FrontLbl">Wireless Campus</h2>
					</div>

					<picture>
					  <img class="image bk-image4" src="images/industry/thumblazy/multiple-simultaneous-users.jpg" style="display: none;">
					</picture>
					<div class="lazyboxx c48-In-container4">
						<h2 class="c48FrontLbl">Multiple Simultaneous Users</h2>
					</div>

					<picture>
					  <img class="image bk-image5" src="images/industry/thumblazy/secure-network.jpg" style="display: none;">
					</picture>
					<div class="lazyboxx c48-In-container5">
						<h2 class="c48FrontLbl">Secure Network</h2>
					</div>

					<picture>
					  <img class="image bk-image6" src="images/industry/thumblazy/hybrid-learning.jpg" style="display: none;">
					</picture>
					<div class="lazyboxx c48-In-container6">
						<h2 class="c48FrontLbl">Hybrid Learning</h2>
					</div>
				</div>
			</div>
		</section>

	</main>

    <?php get_footer();?>

	<script type="text/javascript">

$("#productBlogs").click(function(){
   $(".blogerlists").addClass('product-blog');
   $(".blogerlists").removeClass('learning-blog');
    $(".blogerlists").removeClass('tech-blog');
    $(".blogerlists").removeClass('all-blog');
    $(".blogerlists").removeClass('solution-blog');
    $("#productBlogs").addClass('active');
    $("#techBlogs").removeClass('active');
    $("#learningBlogs").removeClass('active');
    $("#allBlogs").removeClass('active');
    $("#solutionBlogs").removeClass('active');
});

$("#techBlogs").click(function(){
    $(".blogerlists").addClass('tech-blog');
    $(".blogerlists").removeClass('product-blog');
    $(".blogerlists").removeClass('learning-blog');
    $(".blogerlists").removeClass('all-blog');
    $(".blogerlists").removeClass('solution-blog');
    $("#techBlogs").addClass('active');
    $("#productBlogs").removeClass('active');
    $("#learningBlogs").removeClass('active');
    $("#allBlogs").removeClass('active');
    $("#solutionBlogs").removeClass('active');
});

$("#learningBlogs").click(function(){
    $(".blogerlists").addClass('learning-blog');
    $(".blogerlists").removeClass('product-blog');
    $(".blogerlists").removeClass('tech-blog');
    $(".blogerlists").removeClass('all-blog');
    $(".blogerlists").removeClass('solution-blog');
    $("#learningBlogs").addClass('active');
    $("#productBlogs").removeClass('active');
    $("#techBlogs").removeClass('active');
    $("#allBlogs").removeClass('active');
    $("#solutionBlogs").removeClass('active');
});


$("#allBlogs").click(function(){
    $(".blogerlists").addClass('all-blog');
    $(".blogerlists").removeClass('tech-blog');
    $(".blogerlists").removeClass('product-blog');
    $(".blogerlists").removeClass('learning-blog');
    $(".blogerlists").removeClass('solution-blog');
    $("#allBlogs").addClass('active');
    $("#productBlogs").removeClass('active');
    $("#techBlogs").removeClass('active');
    $("#learningBlogs").removeClass('active');
    $("#solutionBlogs").removeClass('active');
});

$("#solutionBlogs").click(function(){
    $(".blogerlists").addClass('solution-blog');
    $(".blogerlists").removeClass('tech-blog');
    $(".blogerlists").removeClass('product-blog');
    $(".blogerlists").removeClass('learning-blog');
    $(".blogerlists").removeClass('all-blog');
    $("#solutionBlogs").addClass('active');
    $("#productBlogs").removeClass('active');
    $("#techBlogs").removeClass('active');
    $("#learningBlogs").removeClass('active');
    $("#allBlogs").removeClass('active');
});

$(".tagshoow").click(function (e) {
     e.stopPropagation();
    $(".tags-main").hide();
    $(this).next().show();

});

$(document).click(function(e){
	$(".tags-main").hide();
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


// $(function(){
// 	$('#blog2search').on('keyup', function() {
// 		var value = $(this).val();
// 	    var patt = new RegExp(value, "i");
// 	    $('.blogerlists').find('.blogbox').each(function() {
// 		var $table = $(this);
// 		console.log($table.children('.blogdesc').children('h4').find('a').text());
// 		if (!($table.children('.blogdesc').children('h4').find('a').text().search(patt) >= 0)) {
// 		$table.show();
// 		}
// 		if (($table.children('.blogdesc').children('h4').find('a').text().search(patt) >= 0)) {
// 			$table.show();
// 		}
// 	});

// 	});
// });
	</script>

    <script type="text/javascript">
        // owl-carousel
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        dots: true,
        autoplay: true,
        items: 1,
        autoplayTimeout:4000,
      });
    </script>

    <script type="text/javascript">
      $('.search_bar input').keyup(function() {
            filter(this); 
        });

        function filter(element) {
            var value = $(element).val().toLowerCase();
            $(".blog-boxed").hide().filter(function() {
                return $(this).text().toLowerCase().indexOf(value) > -1;
            }).show();
        }
  </script>

