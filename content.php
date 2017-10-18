<?php
/**
 * The default template for displaying content
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <div class="featured-post"><?php _e( 'Featured post', 'catcheverest' ); ?></div>
    <?php endif; ?>

    <?php if( has_post_thumbnail() ):?>
    	<figure class="featured-image">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'catcheverest' ), the_title_attribute( 'echo=0' ) ) ); ?>">
            <?php the_post_thumbnail( 'featured' ); ?>
        </a>
        </figure>
    <?php endif; ?>

    <div class="entry-container">

		<header class="entry-header">
    		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'catcheverest' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php if ( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php catcheverest_footer_meta(); ?> <!-- crcustom -->
                </div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php
		// Getting data from Theme Options
		global $catcheverest_options_settings;
		$options = $catcheverest_options_settings;
		$current_content_layout = $options['content_layout'];
		$catcheverest_excerpt = get_the_excerpt();

		if ( is_search() || ( !is_single() && $current_content_layout=='excerpt' && !empty( $catcheverest_excerpt ) ) ) : ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php else : ?>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'catcheverest' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'catcheverest' ), 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
        <?php endif; ?>

        <footer class="entry-meta"> <!-- begin crcustom -->
	        <?php if ( comments_open() && ! post_password_required() ) : ?>
                <span class="comments-link">
                    <?php comments_popup_link(__('Leave a reply', 'catcheverest'), __('1 Reply', 'catcheverest'), __('% Replies', 'catcheverest')); ?>
                </span>
            <?php endif; ?> <!-- end crcustom -->



        </footer><!-- .entry-meta -->

  	</div><!-- .entry-container -->

</article><!-- #post-<?php the_ID(); ?> -->
