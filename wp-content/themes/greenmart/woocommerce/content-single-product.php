<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
 
$current_theme 		= greenmart_tbay_get_theme();
$only_organic  		= greenmart_tbay_only_organic();
$styles   	   		= apply_filters( 'woo_class_single_product', 10, 2 );

$class_single = ($current_theme === 'organic-el' || $current_theme === 'fresh-el') ? 'col-md-6' :'';

$active_full = greenmart_woo_single_product_active_full();
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

	do_action( 'tbay_woocommerce_before_single_product' );
?>

<?php 
	if($active_full) {
		echo '<div class="row row-active-full"><div class="product-inside-wrapper col-12 col-xl-8">';
	}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $styles, $product ); ?>>
	<div class="row">
		<div class="image-mains <?php echo esc_attr($class_single ) ?>">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="information <?php echo esc_attr($class_single ) ?>">
			<?php
				$summary_class = '';
				if ( intval( greenmart_tbay_get_config('enable_buy_now', false) ) ) {
		            $summary_class = ' has-buy-now';
		        }
			?>
			<div class="summary entry-summary <?php echo esc_attr($summary_class); ?>">

				<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div><!-- .summary -->
		</div>
	</div>
<?php  if ( !in_array($current_theme, $only_organic) ) {

	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 0
	 * @hooked greenmart_woocommerce_ywfbt_single_product - 5
	 * @hooked woocommerce_output_related_products - 20
	 */
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	add_action( 'woocommerce_after_single_product_summary', 'greenmart_woocommerce_ywfbt_single_product', 0 ); 
	add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 5);

	if($active_full) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );  
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 5);
	} 

	do_action( 'woocommerce_after_single_product_summary' );

	if($active_full) {
		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );  
	}

	} ?>
</div><!-- #product-<?php the_ID(); ?> -->

<?php 
	if($active_full) {
		echo '</div><div class="product-related-wrapper col-12 col-xl-4">';   
		add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 10 );
		add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
	}

	do_action( 'woocommerce_after_single_product' ); 

    if ($active_full) {
		echo '</div></div>';
		remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 10 );
		remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
    }
?>
