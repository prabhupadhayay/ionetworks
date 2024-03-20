<?php

class Wp_Author_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Wp_Author_Widget', // Base ID
			esc_html__( 'WP Author Profile Widget', 'wpauthor' ), // Name
			array( 'description' => esc_html__( ' Widget for Author Profile.', 'wpauthor' ), ) // Args
		);
	}

	/**
	 * Author Bio Widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
				<div class="wp-author-widget">
                    <figure class="text-center">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 180 ); ?>
                    </figure>
                    <div class="post_header_title text-center">
                        <h6 class="blog-title"><a href="#"><?php echo get_the_author_meta( 'first_name' ) ; ?></a></h6>
                        <small>
							<?php if ( get_the_author_meta( 'designation' ) ) { ?>
							<?php the_author_meta( 'designation' ); ?>
							<?php }?>
						</small>
                    </div>
                    <p><?php echo wpautop( get_the_author_meta( 'description' ) ); ?></p>
					<div class="about-footer">
						<a href="<?php echo get_author_posts_url( get_the_author_meta('ID')); ?>" class="more"><?php echo _e('READ ARTICLE', 'wpauthor')?></a>
						<ul class="social-icons list-inline text-right">
							<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'facebook' ); ?>" target="_blank"><i class="fa icon-facebook"></i></a> 
								</li>
							<?php }?>
							<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'twitter' ); ?>" target="_blank"><i class="fa icon-twitter"></i></a> 
								</li>
							<?php }?>
							<?php if ( get_the_author_meta( 'linkedin' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'linkedin' ); ?>" target="_blank"><i class="fa icon-linkedin"></i></a> 
								</li>
							<?php }?>
							<?php if ( get_the_author_meta( 'gplus' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'gplus' ); ?>" target="_blank"><i class="fa icon-gplus"></i></a> 
								</li>
							<?php }?>
							<?php if ( get_the_author_meta( 'instagram' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'instagram' ); ?>" target="_blank"><i class="fa icon-instagram"></i></a> 
									
								</li>
							<?php }?>
							<?php if ( get_the_author_meta( 'stackoverflow' ) ) { ?>
								<li>
									<a href="<?php the_author_meta( 'stackoverflow' ); ?>" target="_blank"><i class="fa icon-stackoverflow"></i></a> 
								</li>
							<?php }?>
						</ul>
					</div>
                </div>    
		<?php echo $args['after_widget'];
	}
	 
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'title', 'wpauthor' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wpauthor' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Agency_Author_Widget

// register Foo_Widget widget
function register_wp_author_widget() {
    register_widget( 'Wp_Author_Widget' );
}
add_action( 'widgets_init', 'register_wp_author_widget' );

//========== Author Social Profile =============
add_filter( 'user_contactmethods', 'wp_author_custom_contact_info' );
/**
 * @param array $fields  Array of default contact fields.
 * @return array $fields Amended array of contact fields.
 */
function wp_author_custom_contact_info( $fields ) {
    // Add LinkedIn.
    $fields['designation'] = __( 'Designation','wpauthor' );
    $fields['facebook'] = __( 'Facebook','wpauthor' );
    $fields['twitter'] = __( 'Twitter','wpauthor' );
    $fields['linkedin'] = __( 'LinkedIn','wpauthor' );
    $fields['gplus'] = __( 'Google plus','wpauthor' );
    $fields['instagram'] = __( 'Instagram','wpauthor' );
    $fields['stackoverflow'] = __( 'StackOverflow','wpauthor' );
     
    // Return the amended contact fields.
    return $fields;
     
}