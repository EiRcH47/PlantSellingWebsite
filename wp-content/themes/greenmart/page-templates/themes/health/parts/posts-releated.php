<?php
    $relate_count = greenmart_tbay_get_config('number_blog_releated', 2);
    $relate_columns = greenmart_tbay_get_config('releated_blog_columns', 2);
    $terms = get_the_terms( get_the_ID(), 'category' );
    $termids =array();
    $nav_type = 'yes';
    $pagi_type = 'no';
    if ($terms) {
        foreach($terms as $term) {
            $termids[] = $term->term_id;
        }
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $relate_count,
        'post__not_in' => array( get_the_ID() ),
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $termids,
                'operator' => 'IN'
            )
        )
    );

    $relates = new WP_Query( $args );

    $active_theme = greenmart_tbay_get_part_theme();

    if( $relates->have_posts() ):
    
?> 
    <div class="widget">
        <h4 class="widget-title">
            <span><?php esc_html_e( 'Related post', 'greenmart' ); ?></span>
        </h4>

        <div class="related-posts-content  widget-content">
            <?php 
                $class_column = 12/$relate_columns; 
                $nav_type       = ($nav_type == 'yes') ? 'true' : 'false';
                $pagi_type       = ($pagi_type == 'yes') ? 'true' : 'false';
            ?>
            <div class="owl-carousel" data-carousel="owl" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($relate_columns); ?>" data-nav="<?php echo esc_attr( $nav_type ); ?>" data-pagination="<?php echo esc_attr( $pagi_type ); ?>" data-large="<?php echo esc_attr($relate_columns); ?>" data-medium="<?php echo esc_attr($relate_columns); ?>" data-smallmedium="2" data-extrasmall="1">
            <?php
                while ( $relates->have_posts() ) : $relates->the_post();
                    ?>
                    <div class="item">
                          <?php get_template_part( 'vc_templates/post/'.$active_theme.'/_single_carousel_relate' ); ?>
                    </div>
                    <?php
                endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        
    </div>
<?php endif; ?>