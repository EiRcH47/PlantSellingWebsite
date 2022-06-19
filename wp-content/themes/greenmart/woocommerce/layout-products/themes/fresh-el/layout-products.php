<?php 

	$product_style = 'inner-'. $product_style;

	$flash_sales 		= isset($flash_sales) ? $flash_sales : false;
	$end_date 			= isset($end_date) ? $end_date : '';

	$countdown_title 	= isset($countdown_title) ? $countdown_title : '';
	$countdown 			= isset($countdown) ? $countdown : false;

  $classes = array('products-grid', 'product');
?>
<div <?php echo trim($attr_row); ?>>

    <?php if ( !empty($banner_id) && isset($banner_id) && $layout_product !== 'carousel' ) : ?>
      <div class="item">
        <?php 
          if( $enable_banner_link !== 'yes' ) {
            echo ( !empty( $banner_url ) ) ? '<a href="'. esc_url($banner_url) .'">' : '';
          } else { 
            echo ( !empty( $banner_url ) ) ? '<a '. $banner_url .'>' : '';
          }

          echo wp_get_attachment_image($banner_id, 'full'); 
          echo ( !empty( $banner_url ) ) ? '</a>' : '';
        ?>
      </div>
    <?php endif; ?>

    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

        <div class="item">
          <div <?php wc_product_class( $classes, $product ); ?>>
            <?php 
                $post_object = get_post( get_the_ID() );
                setup_postdata( $GLOBALS['post'] =& $post_object );
                
              wc_get_template( 'item-product/themes/fresh-el/'. $product_style .'.php', array('flash_sales' => $flash_sales, 'end_date' => $end_date, 'countdown_title' => $countdown_title, 'countdown' => $countdown, 'product_style' => $product_style ) ); 
            ?>
          </div>
        </div>

    <?php endwhile; ?> 
</div>

<?php wp_reset_postdata(); ?>