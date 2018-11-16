<?php
/**
 * Plugin Name: Single Post Content Plus
 * Description: Adds a sidebar/widget to single posts.
 * Version: 0.1.0
 * Author: Sheldon Francis
 * Author URI: https://sheldonfweb.com
 * Text Domain: spcp
 * License: GPL 2.0+
 * Github URL:
 */

// If this file is called, ABORT
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'spcp_login_stylesheet' );
/**
 * Load custom on login page
 */
function spcp_login_stylesheet() {
	if ( apply_filters( 'spcp_load_styles', true ) ) {
		wp_enqueue_style( 'spcp-custom-stylesheet', plugin_dir_url( __FILE__ ) . 'spcp-styles.css' );
	}
}
//Move to a read or documentation
// Uncomment the following line to keep spcp-custom-stylesheet from loading
// add_filter( 'spcp_load_styles', '__return false' );

add_action( 'widgets_init', 'spcp_register_sidebar' );
/**
 * Register a sidebar
 * */
function spcp_register_sidebar() {
	// register_sidebar
	register_sidebar( array(
		'name' 			=> __( 'Post Content Plus', 'spcp' ),
		'id'   			=> 'spcp-sidebar',
		'description' 	=> __( 'Widgets in this area display single posts', 'spcp' ),
		'before_widget' => '<div class="widget spcp-sidebar">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h2 class="widgettitle spcp-title">',
		'after_title' 	=> '</h2>',
	) );
}

add_filter( 'the_content', 'spcp_display_sidebars' );
/**
 * Display on Single Post Page with active side in the main query
 * */
function spcp_display_sidebars( $content ) {
	if ( is_single() && is_active_sidebar( 'spcp-sidebar' ) && is_main_query() ) {
		dynamic_sidebar( 'spcp-sidebar' );
	}
	return $content;
}
