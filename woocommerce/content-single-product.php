<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see       http://docs.woothemes.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

?>

<?php
  /**
   * woocommerce_before_single_product hook.
   *
   * @hooked wc_print_notices - 10
   */
   do_action( 'woocommerce_before_single_product' );

   if ( post_password_required() ) {
    echo get_the_password_form();
    return;
   }
?>

<?php
  global $product;
  $author_name = '';
  $author_name = $product->get_attribute( 'Author' );
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class='header entry-header'>
    <?php
      add_action( 'crpress_single_product_header', 'woocommerce_template_single_title', 5 );
      do_action( 'crpress_single_product_header' );

      if ($author_name) {
        echo "<h3>by ".$author_name."</h3>";
      }
    ?>
  </div>

  <div class='main'>
    <!-- Summary -->
    <div class="summary entry-summary">

      <div class='entry-image'>
        <?php
          /**
           * woocommerce_before_single_product_summary hook.
           *
           * @hooked woocommerce_show_product_sale_flash - 10
           * @hooked woocommerce_show_product_images - 20
           */
          do_action( 'woocommerce_before_single_product_summary' );

        ?>
        <!-- Product Meta -->
        <div class='entry-meta'>
          <ul>
            <li><?php the_title(); ?></li>
            <li>Price: <?php echo $product->get_price_html(); ?></li>
            <?php
              $product_attributes = $product->get_attributes();
              foreach ( $product_attributes as $attribute ) {
                if ($attribute['is_visible']) {
                  echo '<li>';
                  echo $attribute['value'];
                  echo '</li>';
                }
              }
            ?>
          </ul>
        </div>
      </div>

      <?php
        add_action( 'crpress_single_product_summary', 'the_content', 20 );
        do_action( 'crpress_single_product_summary' );
      ?>


    </div>
    <!-- END Summary -->

    <!-- Sidebar -->
    <div class='sidebar entry-sidebar'>
      <!-- Pricing and Add to Cart -->
      <div class='sidebar-pricing crpress-add-to-cart'>
        <?php
          add_action( 'crpress_single_product_sidebar', 'woocommerce_template_single_price', 10 );
          add_action( 'crpress_single_product_sidebar', 'woocommerce_template_single_add_to_cart', 30 );
          do_action( 'crpress_single_product_sidebar' );
        ?>
      </div>
      <!-- END Pricing and Add to Cart -->

      <!-- Social -->
      <div class='sidebar-sharing'>
        <div class='sidebar-sharing-block sharing-social'>
          <!-- Facebook -->
          <div class='fb-sharing'>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-like" data-href="<?php echo get_permalink(get_the_ID()); ?>" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
          </div>
          <!-- END Facebook -->

          <!-- Twitter -->
          <div class='twitter-sharing'>
            <a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false" data-size='small'>Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>
          <!-- END Twitter -->
        </div>

        <div class='sidebar-sharing-block sharing-manual'>
          <!-- Email -->
          <span class='email-sharing'>
            <a href='mailto:?subject=<?php echo the_title(); ?>&body=<?php echo the_permalink(); ?>' class='btn-email'>
              <img src='/wp-content/themes/catch-everest/images/icon-email.svg' alt='Email' />
            </a>
          </span>
          <!-- END Email -->

          <!-- Print -->
          <span class='print-sharing'>
            <button class='btn-print'>
              <img src='/wp-content/themes/catch-everest/images/icon-print.svg' alt='Email' />
            </button>

          </span>
          <!-- END Print -->
        </div>

        <script>
          jQuery('document').ready(function($){
            $('.btn-print').on('click', function(){
              window.print();
            });
          });
        </script>

      </div>
      <!-- END Social -->

      <!-- Begin MailChimp Signup Form -->
      <div id="crpress-sidebar-widget" class="crpress-widget crpress-newsletter-form">
        <?php if ( is_active_sidebar( 'crpress-sidebar-widget' ) ) : ?>
          <?php dynamic_sidebar( 'crpress-sidebar-widget' ); ?>
        <?php endif; ?>
      </div>  
      <!--End mc_embed_signup-->

      <!-- About the Author -->
      <?php
        // Get the Author based on Product Attribute
        function crpress_get_author(){
          global $product;
          $author_name = $product->get_attribute( 'Author' );
          $content_post = get_page_by_title($author_name, OBJECT, 'post');
          $content = $content_post->post_content;
          $content = apply_filters('the_content', $content);
          $content = str_replace(']]>', ']]&gt;', $content);

          if ( $author_name ) {
            echo "<div class='sidebar-author'>";
            echo "<h2>About the Author</h2>";
            echo "<h3><a href='".get_permalink($content_post)."'>".$author_name."</a></h3>";
            echo "<div class='author-summary'>".$content.'</div>';
            echo "</div>";
          }

        }
        // END crpress_get_author()

        // add_action( 'crpress_about_the_author', 'crpress_get_author' );
        add_action( 'crpress_about_the_author', 'crpress_get_author' );
        do_action( 'crpress_about_the_author' );
      ?>
      <!-- END About the Author -->


      <!-- Other Category Titles -->
      <div class='sidebar-category-titles'>
        <?php
          $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
          $category_name = '';

          if ( $product_cats && ! is_wp_error ( $product_cats ) ){
            $single_cat = array_shift( $product_cats );
            $category_name = $single_cat->name;
          }
        ?>

        <h2>C&R <?php echo $category_name; ?> Titles</h2>
        <ul>
          <?php
            $args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'product_cat' => $category_name, 'post__not_in' => array( get_the_ID() ) );
            $sidebar_loop = new WP_Query( $args );
            while ( $sidebar_loop->have_posts() ) : $sidebar_loop->the_post(); global $product; ?>
              <li>
                <a href="<?php echo get_permalink( $sidebar_loop->post->ID ) ?>" title="<?php echo esc_attr($sidebar_loop->post->post_title ? $sidebar_loop->post->post_title : $sidebar_loop->post->ID); ?>">
                  <?php the_title(); ?>
                </a>
              </li>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </ul>
      </div>
      <!-- END Other Category Titles -->
    <!-- END Sidebar -->
    </div>
  </div>


  <!-- Upsells and Related Products -->
  <?php
    // function crpress_output_related_products() {
    //   $args = array(
    //     'pool_size'         => 50,
    //     'posts_per_page'    => 8,
    //     'columns'           => 4,
    //     'order'             => 'ASC',
    //     'orderby'           => 'date'
    //   );
    //   woocommerce_related_products( apply_filters( 'woocommerce_output_category_products_args', $args ) );
    // }

    add_action( 'crpress_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    // add_action( 'crpress_after_single_product_summary', 'crpress_output_related_products', 20 );
    do_action( 'crpress_after_single_product_summary' )
  ?>

  <!-- Related Products -->
  <div class='main crpress-related-products'>
    <h2>Related Products</h2>
    <ul class='crpress-list-products'>
      <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => $category_name, 'post__not_in' => array( get_the_ID() ) );
        $related_products = new WP_Query( $args );
        while ( $related_products->have_posts() ) : $related_products->the_post(); global $product; ?>
          <li class='crpress-product'>
            <a href="<?php echo get_permalink( $related_products->post->ID ) ?>" title="<?php echo esc_attr($related_products->post->post_title ? $related_products->post->post_title : $related_products->post->ID); ?>">
              <?php if ($product->is_on_sale()) { ?>
                <span class='cr-sale-badge onsale'>Sale!</span>
              <?php } ?>
              <div class='crpress-product-image'>
                <?php echo $product->get_image(); ?>
              </div>
              <h3><?php the_title(); ?></h3>
            </a>
            <div class='crpress-product-details'>
              <div class='crpress-product-price'><?php echo $product->get_price_html(); ?></div>
              <?php echo "<a href='".$product->add_to_cart_url()."' class='button'>".$product->add_to_cart_text()."</a>"; ?>
            </div>
          </li>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
    </ul>
  </div>


  <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
