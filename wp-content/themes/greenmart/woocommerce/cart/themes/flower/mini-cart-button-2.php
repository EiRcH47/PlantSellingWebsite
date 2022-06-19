<?php   
	global $woocommerce; 
	$_id = greenmart_tbay_random_key();
?>
<div class="tbay-topcart">
 <div id="cart" class="cart-dropdown dropdown version-1">
        <a class="dropdown-toggle mini-cart v2" data-offcanvas="offcanvas-left" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_attr_e('View your shopping cart', 'greenmart'); ?>">
            
	        <span class="text-skin cart-icon">
				<i class="icon-handbag"></i>
				<span class="mini-cart-items">
				   <?php echo sprintf( '%d', $woocommerce->cart->cart_contents_count );?>
				</span>
			</span>
            
        </a>            
    </div>
</div>    

<div class="tbay-dropdown-cart v2">
	<div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>
</div>