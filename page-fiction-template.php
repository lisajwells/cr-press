<?php
/*
 Template Name: Fiction
 */?>



<?php get_header(); ?>

<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				

				<?php endwhile; // end of the loop. ?>
				
				<?php echo do_shortcode("[ic_add_posts category='fiction' showposts='10' order='DESC' paginate='yes']"); ?>
				

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>