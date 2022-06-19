<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $category && !empty($category) && !empty( $term = get_term_by( 'slug', $category, 'product_cat' ) ) ):
    $args = array(
        'taxonomy'     => 'product_cat',
        'child_of'     => 0,
        'parent'       => $term->term_id,
        'number'       => $number,
    );
    $sub_cats = get_categories( $args );

    if( $image_cat && !empty( $image_cat )) {
        $image = wp_get_attachment_image_src( $image_cat, 'postthumb-grid');
    } else {
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_image_src( $thumbnail_id, 'postthumb-grid');
    }

?>
    <div class="widget <?php echo esc_attr($align); ?> <?php echo esc_attr($el_class); ?>">
        <?php if ($title!=''): ?>
            <h3 class="widget-title">
                <span><?php echo esc_html( $title ); ?></span>
                <?php if ( isset($subtitle) && $subtitle ): ?>
                    <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
        <div class="widget-content">
            <div class="tbay-category-info">
                <div class="category-info-content">
                    <div class="info-head">
                        <h4 class="category-info-title"><span><?php echo esc_html($term->name); ?></span></h4>
                        <small><?php echo esc_html($term->count); ?> <?php esc_html_e( 'Products' ,'greenmart');?></small>  
                    </div>
                    <?php
                    if ( $sub_cats && !empty($sub_cats)) { ?>
                        <ul class="list-unstyled category-info-list">
                            <?php
                                foreach ( $sub_cats as $cat) {
                                    $sub_link = get_term_link( $cat->slug, 'product_cat');
                                    $cat_name = $cat->name ;// .' ('. $cat->count .')';
                                ?>
                                <li class="category-info-list-item">
                                    <a href="<?php echo esc_url( $sub_link ); ?>">
                                        <?php echo esc_html( $cat_name ); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <div class="category-info-link">
                        <a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ); ?>" title="<?php esc_attr_e( 'more', 'greenmart'); ?>" class=""><?php echo esc_html__( '+ more...', 'greenmart' ); ?></a>
                    </div>
                </div>

                <?php if ( $image ) { ?>
                    <div class="category-image">
                        <img src="<?php echo esc_url_raw( $image[0] ); ?>" title="<?php echo esc_attr($term->name); ?>" style="max-width: 100%">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php endif; ?>    
