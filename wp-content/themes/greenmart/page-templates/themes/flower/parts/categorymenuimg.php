<?php if ( has_nav_menu( 'category-menu-image' ) ): ?>

	<?php 
		$tbay_location = 'category-menu-image';
		$locations  = get_nav_menu_locations();
		$menu_id    = $locations[ $tbay_location ] ;
		$menu_obj   = wp_get_nav_menu_object( $menu_id );
		$menu_name  = greenmart_get_transliterate($menu_obj->slug);
	?>
	<nav class="menu tbay-category-menu-image categorymenu tbay_custom_menu treeview-menu" role="navigation">
		<h3 class="category-inside-title"><?php esc_html_e('Categories', 'greenmart'); ?></h3>
		<?php   $args = array(
				'theme_location' => 'category-menu-image',
				'container_class' => 'menu-category-menu-container',
				'menu_class' => 'menu treeview',
				'fallback_cb' => '',
				'menu_id' => 'category-menu-image',
				'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $menu_name .'">%3$s</ul>',
				'walker' => new greenmart_Tbay_Nav_Menu()
			);
			wp_nav_menu($args);
		?>
	</nav>
<?php endif;?>