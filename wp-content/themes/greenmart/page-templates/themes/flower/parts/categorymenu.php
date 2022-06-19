<?php if ( has_nav_menu( 'category-menu' ) ): ?>

<?php 
	$tbay_location = 'category-menu';
	$locations  = get_nav_menu_locations();
	$menu_id    = $locations[ $tbay_location ] ;
	$menu_obj   = wp_get_nav_menu_object( $menu_id );
	$menu_name  = greenmart_get_transliterate($menu_obj->slug);
?>
<div class="category-inside">
		<h3 class="category-inside-title"><?php esc_html_e('All Categories', 'greenmart'); ?></h3>
		<div class="category-inside-content">
			 <nav class="menu tbay-topmenu" role="navigation">
				<?php
					
					$args = array(
						'theme_location' => 'category-menu',
						'container_class' => 'tbay-menu-category list-inline',
						'menu_class' => 'nav navbar-nav megamenu',
						'fallback_cb' => '',
						'menu_id' => 'category-menu',
						'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $menu_name .'">%3$s</ul>',
						'walker' => new greenmart_Tbay_Nav_Menu()
					);
					wp_nav_menu($args);
				?>
			</nav>
		</div>
</div><!-- End Category Menu -->
<?php endif;?>
