<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package online_photography
 */
get_header();
?>

<!-- breadcrumb_area start -->
        <div class="breadcrumb_area">
            <div class="container">
                <div class="breadcumb_cnt">
                    <ul>
                        <li><a href="https://io.hfcl.com">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li><a href="https://io.hfcl.com/blogs">Blogs</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li><?php single_post_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb_area end -->

<div class="blog-area">

	<div id="primary" class="content-area">



		<main class="container">



			<div class="single-post-wrap">



				<?php



				while ( have_posts() ) :



					the_post();







					get_template_part( 'template-parts/content', 'single' );







					the_post_navigation(



						array(



							'prev_text' => '<span class="nav-title-icon-wrapper">' . online_photography_get_svg( array( 'icon' => 'arrow-left' ) ) . ' <span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Blog', 'online-photography' ) . '</span>',



							'next_text' => '<span aria-hidden="true" class="nav-subtitle">' . __( 'Next Blog', 'online-photography' ) . '</span> <span class="nav-title-icon-wrapper">' . online_photography_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span>',



						)



					);







				endwhile; // End of the loop.



				?>



			</div><!-- .single-post-wrap -->



		</main><!-- #main -->

	</div><!-- #primary -->















</div><!-- .container -->


<?php



get_footer();?>





