<?php
/*
Plugin Name: WP Author Profile Widget
Plugin URI:https://wordpress.org/plugins/wp-author-profile-widget
Description: WP Author Profile Widget is a sidebar widget plugins.
Author: B.M. Rafiul Alam
Author URI: https://themesbyte.com
Text Domain: wpauthor
Version: 1.0
*/

if ( file_exists( dirname( __FILE__ ) . '/wp-author-widget.php' ) ) {
	require_once dirname( __FILE__ ). '/wp-author-widget.php';
}

function wpauthor_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'assets/css/style.css' );
    wp_enqueue_style( 'icons', $plugin_url . 'assets/css/fontello.css' );
}
add_action( 'wp_enqueue_scripts', 'wpauthor_load_plugin_css' );
