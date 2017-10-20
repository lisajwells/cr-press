<?php
/** C&R Press
 */

add_filter('widget_text', 'do_shortcode');

// load child-theme responsive.css after parent
function crpress_scripts() {

	wp_enqueue_style( 'crpress-responsive', get_stylesheet_directory_uri() . '/css/responsive.css' );
}
add_action( 'wp_enqueue_scripts', 'crpress_scripts', 99 );


/**
 * Custom C&R Press Functions from former customized theme
 */

/**
 * Register Header Widget
 */
function crpress_header_widget_init() {

  register_sidebar( array(
    'name'          => 'Header Widget Area',
    'id'            => 'crpress-header-widget',
    'before_widget' => '<div>',
    'after_widget'  => '</div>'
  ) );

}
add_action( 'widgets_init', 'crpress_header_widget_init' );

/**
 * Register Product Sidebar Widget
 */
function crpress_sidebar_widget_init() {
  register_sidebar( array(
    'name'          => 'Sidebar Widget Area',
    'id'            => 'crpress-sidebar-widget',
    'before_widget' => '<div>',
    'after_widget'  => '</div>'
  ) );
}
add_action( 'widgets_init', 'crpress_sidebar_widget_init' );


add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );

 // Apply custom args to main query
function custom_woocommerce_get_catalog_ordering_args( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	if ( 'oldest_to_recent' == $orderby_value ) {
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	}

	return $args;
}

// Create new sorting method
function custom_woocommerce_catalog_orderby( $sortby ) {

	$sortby['oldest_to_recent'] = __( 'Oldest to most recent', 'woocommerce' );

	return $sortby;
}
