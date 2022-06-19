<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="widget widget-newletter <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_html( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content"> 
		<?php if (!empty($description)) { ?>
			<p class="widget-description">
				<?php echo trim( $description ); ?>
			</p>
		<?php } ?>		
		
		<?php
            if (function_exists('mc4wp_show_form')) {
            	try {
                    $form = mc4wp_get_form();
                    echo do_shortcode('[mc4wp_form id="'. $form->ID .'"]');
                } catch (Exception $e) {
                    esc_html_e('Please create a newsletter form from Mailchip plugins', 'greenmart');
                }
            }
        ?>
	</div>
</div>