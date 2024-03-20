<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   error_reporting(E_ALL);
	include("include/php-variables.php");

	   $sql ="select * from ".PREFIX."blog_cms ";
	   $query = $functions->query($sql);
	   $emsCMS = $functions->fetch($query);
	   $bannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['image_name'], 'crop', '');

	   $sqlFooter ="select * from ".PREFIX."contact_cms ";
       $queryFooter = $functions->query($sqlFooter);
       $contactCMSFooter = $functions->fetch($queryFooter);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || Blogs </title>
	<meta name="description" content="Get a glimpse of the latest Wi-Fi trends and technologies with IO by HFCL's blogs to stay informed about how Wi-Fi will soon change our world">
	<?php include("include/header-link.php");?>

</head>
<body class="innerpage bloglistpage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
		</section>

		<section class="panelss">
			<div class="container">
				<ul>
					<li>
						<img src="https://io.hfcl.com/blog/wp-content/uploads/2022/03/managed-importance-scaled.jpg">
						<div class="featur-tittle">
							<h2>Test</h2>
							<a href="https://io.hfcl.com/blog/cloud-managed-wi-fi-its-importance">Read More</a>
						</div>
					</li>
					<li>
						<img src="https://io.hfcl.com/blog/wp-content/uploads/2022/03/acceleration-tomorrow-scaled.jpg">
						<div class="featur-tittle">
							<h2>Test</h2>
							<a href="https://io.hfcl.com/blog/digital-acceleration-for-a-better-tomorrow">Read More</a>
						</div>
					</li>
					<li>
						<img src="https://io.hfcl.com/blog/wp-content/uploads/2022/03/growth-catalyst-scaled.jpg">
						<div class="featur-tittle">
							<h2>Test</h2>
							<a href="https://io.hfcl.com/blog/wi-fi-6-a-growth-catalyst-for-smes/">Read More</a>
						</div>
					</li>
				</ul>
			</div>
		</section>

		<section class="container">
			<div class="subfeature-menu">
				<ul>
					<li><a id ="productBlogs" href="javascript:void(0)">Product Blogs</a></li>
					<li><a id="techBlogs" href="javascript:void(0)">IO by HFCL Tech Blogs</a></li>
					<li><a id="learningBlogs" href="javascript:void(0)">Learning Blog</a></li>
                    <!-- <li><a id="allBlogs" href="javascript:void(0)">All</a></li> -->
				</ul>
			

			</div>
		</section>

		<section class="blogpage-section">
			<div class="container p0">
				<div class="blogpage-in">
				<div class="serachblog">
						<form class="serachblogform">
							<div class="form-group">
								<input type="text" id="blog2search" name="s" class="form-control" placeholder="Search blog" required>
							</div>
							<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>

					</div>



					<?php $s = ''; if(isset($_GET['s'])){ $s = $_GET['s']; ?>

<h2>Search Results for <b>"<?php echo $s; ?>"</b></h2>
					<?php } ?>

					<div class="mainblogflex">
						<div class="bloglistout" style="width: 100%;">
                            <div class="blogerlists" style="grid-template-columns: repeat(3, 1fr);">
			                      <?php 
			                        include_once('blog/wp-load.php');
			                         $recent_posts = wp_get_recent_posts(array(
			                           'numberposts' =>15
			                         ));

							//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$paged = 1;
							// $s=get_search_query();


							$args = array(

							's' =>$s,

							'post_type' => 'post',

							'post_status' => 'publish',

							/*'posts_per_page' => 6,*/

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
			                        ?> 
			                                    <div class="blogbox wow fadeInUp" data-wow-delay="0.5s">
			                                        <div class="blogthumbimage">
			                                            <img src="<?php echo $feat_image; ?>" alt="blog_thumb1" loading="lazy">
			                                        </div>
			                                        <div class="blogdesc">
			                                            <div class="writerflexx">
			                                                <div class="writerpic">
			                                                    <img src="<?php echo "$avatar_url";?>" alt="">
			                                                    
			                                                </div>
			                                                <div class="sdppsod">
			                                                	<h5><?php echo $display_name; ?></h5>
			                                                	<h4><?php echo $display_name_post; ?></h4>
			                                                </div>
			                                            </div>
			                                            <h4><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo the_title(); ?></a></h4>
			                                            <p><?php echo substr(strip_tags(get_the_content()),0,60).'...'; ?></p>
			                                            <div class="below-blog-sec">
			                                            		<div class="social-below">
			                                            			<ul>
			                                            				<li><a href="javascript:void(0)"><img src="https://io.hfcl.com/images/svg/facebook.svg"></a></li>
			                                            				<li><a href="javascript:void(0)"><img src="https://io.hfcl.com/images/svg/linkedin.svg"></a></li>
			                                            				<li><a href="javascript:void(0)"><img src="https://io.hfcl.com/images/svg/twitter.svg"></a></li>
			                                            			</ul>
			                                            		</div>
			                                            		<div class="card-tags-dropdown">
			                                            			<a href="javascript:void(0)" class="tagshoow">Tags</a>
			                                            			<ul class="tags-main">
			                                            				<li><a href="">Test</a></li>
			                                            				<li><a href="">Test</a></li>
			                                            				<li><a href="">Test</a></li>
			                                            				<li><a href="">Test</a></li>
			                                            			</ul>
			                                            		</div>
			                                            </div>
			                                        </div>
			                                    </div>
			                      <?php 
			                        $x++; 
			                        }} else { ?>
			                        	<h4>No Result Found.</h4>
			                        <?php } ?>
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

   $("#productBlogs").click(function(){
    $(".blogerlists").addClass('product-blog');
	$(".blogerlists").removeClass('learning-blog');
	$(".blogerlists").removeClass('tech-blog');
	// $(".blogbox").slice(3, 12).addClass('hide-blogbox');
	// $(".blogbox").slice(0, 2).removeClass('hide-blogbox');
});

$("#techBlogs").click(function(){
	
	$(".blogerlists").addClass('tech-blog');
	$(".blogerlists").removeClass('product-blog');
	$(".blogerlists").removeClass('learning-blog');
    
});

$("#learningBlogs").click(function(){
	$(".blogerlists").addClass('learning-blog');
	$(".blogerlists").removeClass('product-blog');
	$(".blogerlists").removeClass('tech-blog');
	
});
	</script>

<script>

$('#blog2search').on('keyup', function() {
  var value = $(this).val();
  var patt = new RegExp(value, "i");

  $('.blogpage-section').find('.blogbox').each(function() {
    var $table = $(this);
    
    if (!($table.find('a').text().search(patt) >= 0)) {
      $table.not('.blogbox').hide();
    }
    if (($table.find('a').text().search(patt) >= 0)) {
      $(this).show();
    }
    
  });
 
});



</script>



</body>
</html>