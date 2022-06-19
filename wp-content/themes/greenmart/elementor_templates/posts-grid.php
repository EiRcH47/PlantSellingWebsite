<?php 
/**
 * Templates Name: Elementor
 * Widget: Post Grid
 */

$query = $this->query_posts();

if (!$query->found_posts) {
    return;
}
$this->settings_layout();
$this->add_render_attribute('item', 'class', 'item');

$style = $settings['style'];

$configs = array(
    'style',
    'thumbnail_size_size',
    'excerpt_length',
);

$skin = greenmart_tbay_get_theme(); 
$folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';

foreach ($configs as $value) {
   set_query_var($value, $settings[$value]);
}
set_query_var( 'elementor_activate', true );
?>


<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>

    <div <?php echo trim($this->get_render_attribute_string('row')); ?>>

        <?php while ( $query->have_posts() ) : $query->the_post(); global $product; ?>
            <div <?php echo trim($this->get_render_attribute_string('item')); ?>>
                <?php get_template_part('vc_templates/post/themes/'.$folder_skin.'/item-'. $style); ?>     
            </div>
        <?php endwhile; ?> 
    </div>
</div>

<?php wp_reset_postdata(); ?>