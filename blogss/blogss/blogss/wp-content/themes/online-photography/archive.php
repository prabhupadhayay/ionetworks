<?php



/**



 * The template for displaying archive pages



 *



 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/



 *



 * @package online_photography



 */



function get_breadcrumb() {

    echo '<a href="https://shareittofriends.com/demo/io-networks/website/" rel="nofollow">Home</a>';

    if (is_category() || is_single()) {

        echo "&nbsp;&nbsp;&#8250;&nbsp;&nbsp;";

        the_category(' &bull; ');

            if (is_single()) {

                echo " &nbsp;&nbsp;&#8250;&nbsp;&nbsp; ";

                the_title();

            }

    } elseif (is_page()) {

        echo "&nbsp;&nbsp;&#8250;&nbsp;&nbsp;";

        echo the_title();

    } elseif (is_search()) {

        echo "&nbsp;&nbsp;&#8250;&nbsp;&nbsp;Search Results for... ";

        echo '"<em>';

        echo the_search_query();

        echo '</em>"';

    }

}



get_header();



?>

<section class="subheader_part">
    <div class="container">
        <div class="subheader_item">
            <h1><?php wp_title(''); ?></h1>
            <p><?php wp_title(''); ?> Related Blogs</p>
        </div>
    </div>
</section>
<div class="breadcrumb_area">
    <div class="container">
        <div class="breadcumb_cnt">
            <ul>
                <li><a href="https://io.hfcl.com">Home</a></li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li><?php wp_title(''); ?></li>
            </ul>
        </div>
    </div>
</div>



		<div class="tagsearch-sec">

			<div class="container">



			<div class="row">

			</div>



	

						



				<div class="row">



					<?php if ( have_posts() ) : ?>



						<?php



						/* Start the Loop */



						while ( have_posts() ) :
							the_post();?>







							<div class="col-sm-12 col-md-6 col-lg-4 blog-boxed">

								<div class="tab-item">
									<div class="imghover-effect">

										<?php echo get_the_post_thumbnail( get_the_ID(), 'large' );?>

									</div>

									<div class="tab-cnt">

										<h6><?php echo get_the_title(); ?></h6>

										<?php the_excerpt(); ?>

										<a href="<?php echo get_post_permalink() ?>" class="btn btn-solid btn-hover-swp border-none">
                                            <span class="btn-txt">Read More</span>
                                            <span class="btn-icon"><i class="fa fa-solid fa-plus"></i></span>
                                            <span class="btn-icon"><i class="fa fa-solid fa-plus"></i></span>
                                        </a>

									</div>
								</div>

							</div>

							







						<?php 

						endwhile;

						endif;

						?>

			</div><!-- .blog-archive -->







				
</div>
	</div><!-- .container -->







<?php



get_footer();



