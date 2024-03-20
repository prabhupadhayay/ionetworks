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
			<img src="<?php echo $bannerImageData; ?>" alt="blogbanner" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $emsCMS['title']; ?></h1>
					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $emsCMS['description']; ?></p>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="index.php">Home</a></li>
					<!-- <li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Resources</a></li> -->
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);">Blogs</a></li>
				</ul>
			</div>
		</section>

		<section class="blogpage-section">
			<div class="container p0">
				<div class="blogpage-in">

					<div class="serachblog">
						<form class="serachblogform">
							<div class="form-group">
								<input type="text" name="s" class="form-control" placeholder="Search blog" required>
							</div>
							<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>

					</div>

					<?php $s = ''; if(isset($_GET['s'])){ $s = $_GET['s']; ?>

<h2>Search Results for <b>"<?php echo $s; ?>"</b></h2>
					<?php } ?>

					<div class="mainblogflex">
						<div class="bloglistout">
                            <div class="blogerlists">
			                      <?php 
			                        include_once('blog/wp-load.php');
			                         $recent_posts = wp_get_recent_posts(array(
			                           'numberposts' =>10
			                         ));

							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
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
                            <div class="blogwidgets">
                                <div class="blogwidgetsbox wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="blogwidgethead">
                                        <h4>Popular Articles</h4>
                                    </div>
                                    <div class="blogwidgebottom">
                                        <ul class="popularlist">
                                        	
                                               <?php
                                               include_once('blog/wp-load.php');
                                                    global $post;
                                                    $args = array( 'numberposts' => 5, 'offset'=> 1 );
                                                    $myposts = get_posts( $args );
                                                    foreach( $myposts as $post ) :  setup_postdata($post); ?>
                                            	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                           	<?php endforeach; ?>
                                            <!-- <li><a href="#">Mesh network; best home wireless solution</a></li>
                                            <li><a href="#">Digital acceleration powered by broadband internet for a better tomorrow</a></li>
                                            <li><a href="#">Drive strategic value through Wi-Fi 6 in campus networking</a></li>
                                            <li><a href="#">Cloud-managed Access Points: A Blessing for Enterprises</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="blogwidgetsbox tagsnewbox wow fadeInUp" data-wow-delay="0.55s">
                                    <div class="blogwidgethead">
                                        <h4>Most Searched Topics</h4>
                                    </div>
                                    <div class="blogwidgebottom">
                                        <div class="topicsearched">
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
												<a href="<?php echo get_tag_link( $tag->term_id ); ?>"><img src="<?php echo z_taxonomy_image_url($tag->term_id); ?>" alt="topic_11" loading="lazy"><span><?php echo $tag->name; ?></span></a>
											<?php
											   }
											?>
                                            <!-- <a href="#"><img src="images/topics/topic_11.png" alt="topic_11" loading="lazy"><span>Enterprise</span></a>
                                            <a href="#"><img src="images/topics/topic_10.png" alt="topic_10" loading="lazy"><span>Financial Services</span></a>
                                            <a href="#"><img src="images/topics/topic_7.png" alt="topic_7" loading="lazy"><span>Home</span></a>
                                            <a href="#"><img src="images/topics/topic_2.png" alt="topic_2" loading="lazy"><span>Video Surveillance</span></a>
                                            <a href="#"><img src="images/topics/topic_3.png" alt="topic_3" loading="lazy"><span>Smart Cities</span></a>
                                            <a href="#"><img src="images/topics/topic_1.png" alt="topic_1" loading="lazy"><span>Wi-Fi Backhaul</span></a>
                                            <a href="#"><img src="images/topics/topic_12.png" alt="topic_12" loading="lazy"><span>Education</span></a>
                                            <a href="#"><img src="images/topics/topic_8.png" alt="topic_8" loading="lazy"><span>Healthcare</span></a>
                                            <a href="#"><img src="images/topics/topic_6.png" alt="topic_6" loading="lazy"><span>Hospitality</span></a>
                                            <a href="#"><img src="images/topics/topic_4.png" alt="topic_4" loading="lazy"><span>Retail</span></a>
                                            <a href="#"><img src="images/topics/topic_9.png" alt="topic_9" loading="lazy"><span>Government</span></a>
                                            <a href="#"><img src="images/topics/topic_5.png" alt="topic_5" loading="lazy"><span>Public Wi-Fi</span></a> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="blogwidgetsbox wow fadeInUp" data-wow-delay="0.6s" style="display:none;">
                                    <div class="blogwidgethead">
                                        <h4>Follow Us</h4>
                                    </div>
                                    <div class="blogwidgebottom">
                                        <div class="blogsocial">
                                           <?php 
                           						if(!empty($contactCMSFooter['facebook'])){
                           					?>
                           						<a href="<?php echo $contactCMSFooter['facebook']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/fb.png"></a>
                           					<?php 
                           						} if(!empty($contactCMSFooter['instagram'])){
                           					?>

                           						<a href="<?php echo $contactCMSFooter['instagram']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/insta.png"></a>
                           					<?php 
                           						} if(!empty($contactCMSFooter['twitter'])){
                           					?>
                           						<a href="<?php echo $contactCMSFooter['twitter']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/tw.png"></a>
                           					<?php 
                           						} if(!empty($contactCMSFooter['youtube'])){
                           					?>
                           						<a href="<?php echo $contactCMSFooter['youtube']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/yt.png"></a>
                           					<?php 
                           						} if(!empty($contactCMSFooter['linkedin'])){
                           					?>
                           						<a href="<?php echo $contactCMSFooter['linkedin']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/linkedin.png"></a>
                           					<?php 
                           						}
                           					?>

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