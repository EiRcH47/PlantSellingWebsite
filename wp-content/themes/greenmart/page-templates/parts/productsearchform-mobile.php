

<?php 
	$_id = greenmart_tbay_random_key(); 

	$skin = greenmart_tbay_get_theme(); 
	
	if($skin === 'organic-el' || $skin === 'fresh-el') {
		$search_type = greenmart_tbay_get_config('mobile_search_type');
		$search_category = 0;
		$show_search_product_image = greenmart_tbay_get_config('mobile_show_search_product_image');
		$show_search_product_price = greenmart_tbay_get_config('mobile_show_search_product_price');
		$search_min_chars = greenmart_tbay_get_config('mobile_search_min_chars');
		$search_max_number_results = greenmart_tbay_get_config('mobile_search_max_number_results');
		
		$class = ($mobile_autocomplete_search = 1) ? 'greenmart-ajax-search' :'';

		$string_data = 'data-thumbnail="'. esc_attr( $show_search_product_image ) . '"';
		// $string_data .= ' data-appendto=".result-mobile"';
		$string_data .= ' data-price="'. esc_attr( $show_search_product_price ) . '"';
		$string_data .= ' data-minChars="'. esc_attr( $search_min_chars ) . '"';
		$string_data .= ' data-post-type="'. esc_attr( $search_type ) . '"';
		$string_data .= ' data-count="'. esc_attr( $search_max_number_results ) . '"';
		$placeholder = greenmart_tbay_get_config('mobile_search_placeholder');
	} else {
		$search_type = greenmart_tbay_get_config('search_type');
		$search_category = greenmart_tbay_get_config('search_category');
		$string_data = '';
		$placeholder = esc_attr__('I&rsquo;m searching for...', 'greenmart');
		$class ='';
	}

?>
<div class="tbay-search-form">
	<form class="form-search-mobile <?php echo esc_attr($class); ?>" <?php echo trim($string_data); ?>action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" data-appendto=".result-mobile-<?php echo esc_attr($_id); ?>">
		<div class="form-group">
			<div class="input-group">
				<?php if ( $search_type != 'all' && $search_category ): ?>
					<div class="select-category input-group-addon">
						<?php if ( greenmart_is_woocommerce_activated() && $search_type == 'product' ):
							$args = array(
								'show_counts' => false,
								'hierarchical' => true,
								'show_uncategorized' => 0
							);
						?>
							<?php wc_product_dropdown_categories( $args ); ?>

						<?php elseif ( $search_type == 'post' ):
							$args = array(
								'show_option_all' => esc_html__( 'All categories', 'greenmart' ),
								'show_counts' => false,
								'hierarchical' => true,
								'show_uncategorized' => 0,
								'name' => 'category',
								'id' => 'search-category',
								'class' => 'postform dropdown_product_cat',
							);
						?>
							<?php wp_dropdown_categories( $args ); ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<input type="text" placeholder="<?php echo trim($placeholder); ?>" name="s" required oninvalid="this.setCustomValidity('<?php esc_html_e('Enter at least 2 characters', 'greenmart'); ?>')" oninput="setCustomValidity('')"  class="tbay-search form-control input-sm"/>
					<div class="tbay-preloader"></div>

					<div class="button-group input-group-addon">
						<button type="submit" class="button-search btn btn-sm"><i class="<?php echo greenmart_get_icon('icon_search_mobile'); ?>"></i></button>
					</div>  
					<div class="tbay-search-result result-mobile-<?php echo esc_attr($_id); ?>"></div>
				<?php if ( $search_type != 'all' ): ?>
					<input type="hidden" name="post_type" value="<?php echo esc_attr($search_type); ?>" class="post_type" />
				<?php endif; ?>
			</div>
			
		</div>
	</form>
	<div class="search-mobile-close"></div>
</div>
