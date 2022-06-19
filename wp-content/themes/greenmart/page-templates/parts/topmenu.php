<?php if ( has_nav_menu( 'topmenu' ) ): ?>
    <div class="top-menu">
        <div class="dropdown menu">
            <span data-toggle="dropdown" class="dropdown-toggle"><i class="<?php echo greenmart_get_icon('icon_navigation_menu'); ?>"></i></span>
            <div class="dropdown-menu dropdown-menu-right">
                <nav class="tbay-topmenu" role="navigation">
                    <?php
                        $args = array(
                            'theme_location'  => 'topmenu',
                            'menu_class'      => 'tbay-menu-top list-inline',
                            'fallback_cb'     => '',
                            'menu_id'         => 'topmenu'
                        );
                        wp_nav_menu($args);
                    ?>
                </nav>
            </div>
        </div>
    </div>
<?php endif; ?>