<?php $tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type') );
	if ( empty($tbay_header) ) {
		$tbay_header = 'v1';
	}
?>

<div id="tbay-mobile-menu" class="111tbay-offcanvas hidden-lg hidden-md <?php echo esc_attr($tbay_header);?>"> 
    <div class="tbay-offcanvas-body">
        <div class="offcanvas-head bg-primary">
            <button type="button" class="btn btn-toggle-canvas btn-danger" data-toggle="offcanvas">
                <i class="fa fa-close"></i> 
            </button>
            <strong><?php esc_html_e( 'MENU', 'greenmart' ); ?></strong>
        </div>

        <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
            <?php
                $args = array(
                    'theme_location' => 'primary',
                    'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => '',
                    'menu_id' => 'main-mobile-menu',
                    'walker' => new Greenmart_Tbay_mmenu_menu()
                );
                wp_nav_menu($args);
            ?>
        </nav>

    </div>
</div>