<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title>
C&R Press
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,900,400italic,900italic|Merriweather:400,400italic,900,900italic' rel='stylesheet' type='text/css'>


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


<div id="page" class="hfeed site">

		<header id="masthead" role="banner">

    		<div id="hgroup-wrap" class="container">
        	<a href="http://crpress.org/"><img src="<?php bloginfo('template_directory'); ?>/images/CRLogo_bw.png"/></a>


          <div id="crpress-header-widget" class="crpress-widget">
            <?php if ( is_active_sidebar( 'crpress-header-widget' ) ) : ?>
              <?php dynamic_sidebar( 'crpress-header-widget' ); ?>
            <?php endif; ?>
          	<p class="tagline"><?php echo get_bloginfo('description'); ?></p>
          </div>

        	</div><!-- #hgroup-wrap -->


        	<?php
	        	/**
		        	* catcheverest_before_main hook
		        	*
		        	* HOOKED_FUNCTION_NAME PRIORITY
		        	*
		        	* catcheverest_slider_display 10
		        	* catcheverest_homepage_headline 15
		        	*/
		        	do_action( 'catcheverest_before_main' ); ?>

		     <?php
			     /**
				    * Navigation
				    * catcheverest_header_menu 10
				    */
				    do_action( 'catcheverest_after_hgroup_wrap' ); ?>

		</header><!-- #masthead .site-header -->


<div id="main" class="container">

		<?php
        /**
         * catcheverest_main hook
         *
         * HOOKED_FUNCTION_NAME PRIORITY
         *
	 	 * catcheverest_homepage_featured_display 10
         */
        do_action( 'catcheverest_main' ); ?>
