<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


?>
<div class="widget feature-banner clearfix <?php echo esc_attr($el_class); ?>">
    <?php for ($i=1; $i <= 5; $i++):
        $title = isset($atts['title'.$i]) ? $atts['title'.$i] : '';
        $photo = isset($atts['photo'.$i]) ? $atts['photo'.$i] : '';
        $information = isset($atts['information'.$i]) ? $atts['information'.$i] : '';
        $link = isset($atts['link'.$i]) ? $atts['link'.$i] : '';

        $img = wp_get_attachment_image_src($photo,'full');
    ?>
        
        <div class="col-lg-cus-5 p-relative feature-banner-inner">
            <div class="banner-static">
                <?php if($title!=''): ?>
                    <h3 class="widget-title">
                       <span><?php echo esc_html( $title ); ?></span>
                    </h3>
                <?php endif; ?>

            	<?php if (isset($img[0]) && $img[0]) { ?>
                	<div class="feature-image">
                     <img src="<?php echo esc_url($img[0]);?>" alt="<?php echo esc_attr($title); ?>" />
                	</div>
            	<?php } ?>
            </div>
            <div class="banner-body">  
                <div class="p-relative">
                    <div class="content">
                    <div class="fbox-body">                            
                        <h3 class="widget-title"><?php echo esc_html($title); ?></h3>                      
                    </div>
                    <?php if (trim($information)!='') { ?>
                        <p class="description"><?php echo trim( $information );?></p>  
                    <?php } ?>
                    <?php if ( !empty($link) ){ ?>
                        <a href="<?php echo esc_url_raw($link); ?>"><?php echo esc_html__( 'Learn More', 'greenmart' );?><i class="fa fa-arrow-right"></i></a>  
                    <?php } ?>
                    </div>
                </div>
            </div>      
        </div>
    <?php endfor; ?>
</div>