<?php 
    $tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type') );
    if ( empty($tbay_header) ) {
        $tbay_header = 'v1';
    }
    $location = 'mobile-menu';
    $tbay_location  = '';
    if ( has_nav_menu( $location ) ) {
        $tbay_location = $location;
    }

    $menu_option            = apply_filters( 'greenmart_menu_mobile_option', 10 );
    $menu_title             = greenmart_tbay_get_config('menu_mobile_title', 'Menu mobile');


    $menu_one_id    =  greenmart_tbay_get_config('menu_mobile_one_select');


    $enable_ajax_canvas_menu     = 	greenmart_tbay_get_config('enable_ajax_canvas_menu', false);

    $menu_name = '';
    if ( empty($menu_one_id) ) {
        $locations  = get_nav_menu_locations();

        if( isset($locations[ $tbay_location ]) && !empty($locations[ $tbay_location ]) ) {
            $menu_id    = $locations[ $tbay_location ];
            $menu_obj   = wp_get_nav_menu_object( $menu_id );
            $menu_name  = greenmart_get_transliterate($menu_obj->slug);
        }
    } else {
        $menu_one_obj   = wp_get_nav_menu_object($menu_one_id);
        $menu_name      = greenmart_get_transliterate($menu_one_obj->slug);
    }

    $active_ajax_canvas_menu     = false;
    $data_attr = '';      
    if( $enable_ajax_canvas_menu ) {
        $layout         = 'treeview';

        $data_wrapper = wp_json_encode( [
            'layout'    => $layout,
            'menu_id'   => 'main-mobile-menu',
        ] );

        $data_attr = 'data-wrapper="'. esc_attr($data_wrapper) .'"';

        $active_ajax_canvas_menu = true;
    }  

?>  

<?php if( $menu_option == 'tree_view' ||  $tbay_header == 'v4' ||  $tbay_header == 'v5' ||  $tbay_header == 'v7' ) : ?>

<div id="tbay-mobile-menu" class="tbay-offcanvas hidden-lg hidden-md <?php echo esc_attr($tbay_header);?>" <?php echo trim($data_attr); ?>>
    <div class="tbay-offcanvas-body">

        <?php if( isset($menu_title) && !empty($menu_title) ) : ?>
            <div class="offcanvas-head">
                <?php echo trim($menu_title); ?>
                <button type="button" class="btn btn-toggle-canvas btn-danger" data-toggle="offcanvas">x</button>
            </div>
        <?php endif; ?>
        

        <nav id="tbay-mobile-menu-navbar-treeview" class="menu navbar navbar-offcanvas navbar-static" data-id="<?php echo esc_attr($menu_name); ?>">
            <?php
                if ( !$active_ajax_canvas_menu ) {
                    $args = array(
                        'fallback_cb' => '',
                    );

                    if (empty($menu_one_id)) {
                        $args['theme_location']     = $tbay_location;
                    } else {
                        $args['menu']               = $menu_one_id;
                    }
 
                    $args['menu_class']         =   'menu treeview nav navbar-nav';
                    $args['container_class']    =   'navbar-collapse navbar-offcanvas-collapse';
                    $args['items_wrap']         =   '<ul id="%1$s" class="%2$s" data-id="'. $menu_name .'">%3$s</ul>';
                    $args['menu_id']            =   'main-mobile-menu';
                    $args['walker']             =   new Greenmart_Tbay_Nav_Menu();

                    wp_nav_menu($args);
                }


            ?>
        </nav>


    </div>
</div>

<?php endif; ?>