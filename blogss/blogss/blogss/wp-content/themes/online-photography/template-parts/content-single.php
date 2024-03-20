	<?php
	/**
	 * Template part for displaying posts
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package online_photography
	 */

	global $wp;
	$url = home_url(add_query_arg(array(), $wp->request));
	?>







	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



		<div class="blog-post-item">



			<header class="blog-upper">



				<?php



				if ( is_singular() ) :



					the_title( '<h1>', '</h1>' );



				else :



					the_title( '<h1><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );



				endif; ?>



			</header><!-- .entry-header -->



			<div class="blog_main">

				<div class="row">

				<div class="col-lg-9">

					<?php online_photography_post_thumbnail(); ?>

					<?php the_content(); ?>

				</div>

				<div class="col-lg-3">

					<div class="bloglist_right tab_right">

								<div class="feature-cnt">
									<h4>Highlights</h4>
									<?php dynamic_sidebar( 'sidebar-1' ); ?>
								</div>

                                <div class="feature-cnt">
                                    <h4>Date</h4>
                                    <p><?php echo get_the_date();?></p>
                                </div>
                                <div class="feature-cnt">
                                    <h4>Share</h4>
                                    <div class="social_icon">
                                        <ul>
                                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(get_the_ID()); ?>"><img src="https://io.hfcl.com/images/social/linkedin.svg" alt=""></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(get_the_ID()); ?>"><img src="https://io.hfcl.com/images/social/tw.svg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="feature-cnt">
                                    <h4>Author</h4>
                                    <div class="author_item">
                                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 102 ); ?>
                                        <div class="author_cnt">
                                            <h4><?php echo get_the_author(); ?></h4>
                                            <p><?php echo the_author_meta('description');?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-cnt">
                                    <h4>Tags</h4>
                                    <div class="tags">
                                        <ul>
                                            <?php

								   $args = array(

								            'hide_empty'       => 0,

									       'orderby'          => 'name'

							        );

								  

								   	$cat_logo = z_taxonomy_image_url($term->term_id);

								   	$cats = get_tags();

    								$category_link = '';

								   	$cats = get_tags($args);

									   foreach($cats as $cat) {

									?>

										<li><a href="<?php echo get_tag_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li>

									<?php

									   }

									?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="feature-cnt border-0">
                                    <h4>You Might Also Like</h4>
                                    <ul>
                                        <li><a href="https://io.hfcl.com/blog/ont-devices-bridging-the-gap-to-ultra-fast-internet/">ONT Devices: Bridging the Gap to Ultra-Fast Internet</a></li>
                                        <li><a href="https://io.hfcl.com/blog/wired-to-win-an-ultimate-guide-to-poe-switches/">Wired to Win: An Ultimate Guide to PoE Switches</a></li>
                                        <li><a href="https://io.hfcl.com/blog/what-is-ont/">Exploring ONT: The Cornerstone of Modern Optical Networking</a></li>
                                        <li><a href="https://io.hfcl.com/blog/best-place-to-put-wi-fi-router/">How To Position Your Wi-Fi Router For Optimal Performance?</a></li>
                                        <li><a href="https://io.hfcl.com/blog/fueling-progress-in-the-oil-and-gas-industry-with-wireless-network-solutions/">Fueling Progress in the Oil and Gas Industry with Wireless Network Solutions</a></li>
                                    </ul>
                                </div>                                
                            </div>

				</div>

				</div>

			</div><!-- .entry-content -->







		</div><!-- .blog-post-item -->



	</article><!-- #post-<?php the_ID(); ?> -->



