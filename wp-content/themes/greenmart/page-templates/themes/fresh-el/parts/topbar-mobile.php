<div class="topbar-mobile  hidden-lg hidden-md hidden-xxs clearfix">
	<div class="logo-mobile-theme col-xs-6 text-left">
		<?php get_template_part( 'page-templates/parts/logo' ); ?>

        <?php
        printf(
            '<%1$s class="site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>',
            is_home() || is_front_page() ? 'h1' : 'p',
            esc_url( home_url( '/' ) ), 
            get_bloginfo( 'name' )
        );
        ?>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
     <div class="topbar-mobile-right col-xs-6 text-right">
        <div class="active-mobile">
            <?php echo apply_filters( 'greenmart_get_menu_mobile_icon', 10,2 ); ?>
        </div>
        <div class="topbar-inner">
            <div class="search-device">
				<a class="show-search" href="javascript:;"><i class="icon-magnifier icons"></i></a>
				<?php get_template_part( 'page-templates/parts/productsearchform-mobile' ); ?>
			</div>
            
            <div class="setting-popup">

                <div class="dropdown">
                    <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-user"></span></button>
                    <div class="dropdown-menu">
                        <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                            <div class="pull-left">
                                <?php
                                    $args = array(
                                        'theme_location'  => 'topmenu',
                                        'container_class' => '',
                                        'menu_class'      => 'menu-topbar'
                                    );
                                    wp_nav_menu($args);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="active-mobile top-cart">

                <div class="dropdown">
                    <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-shopping-cart"></span></button>
                    <div class="dropdown-menu">
                        <div class="widget_shopping_cart_content"></div>
                    </div>
                </div>
                
            </div>  
        </div>
    </div>       
</div>
