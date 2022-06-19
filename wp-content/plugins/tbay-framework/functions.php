<?php
/**
 * functions for tbay framework
 *
 * @package    tbay-framework
 * @author     Team Thembays <tbaythemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Tbay Framework
 */

if( ! function_exists( 'tbay_framework_add_param' ) ) {
    function tbay_framework_add_param() {
        if ( function_exists('vc_add_shortcode_param') ) {

            $min = '.min';
            
            vc_add_shortcode_param('googlemap', 'tbay_framework_parram_googlemap', get_template_directory_uri().'/js/admin/googlemap'. $min .'.js');
        }
    }
}

if( ! function_exists( 'tbay_framework_parram_googlemap' ) ) {
    function tbay_framework_parram_googlemap($settings, $value) {
        return apply_filters( 'tbay_framework_parram_googlemap', '
            <div id="tbay-element-map">
                <div class="map_canvas" style="height:200px;"></div>

                <div class="vc_row-fluid googlefind">
                    <input id="geocomplete" type="text" class="tbay-location" placeholder="Type in an address" size="90" />
                    <button class="button-primary find">'.esc_html__('Find', 'tbay-framework').'</button>
                </div>

                <div class="row-fluid mapdetail">
                    <div class="span6">
                        <div class="wpb_element_label">'.esc_html__('Latitude', 'tbay-framework').'</div>
                        <input name="lat" class="tbay-latgmap" type="text" value="">
                    </div>

                    <div class="span6">
                        <div class="wpb_element_label">'.esc_html__('Longitude', 'tbay-framework').'</div>
                        <input name="lng" class="tbay-lnggmap" type="text" value="">
                    </div>
                </div>
            </div>
            ');
    }
}

if( ! function_exists( 'tbay_framework_register_post_types' ) ) {
    function tbay_framework_register_post_types() {
        $types = array('footer', 'brand', 'testimonial', 'megamenu');
        $post_types = apply_filters( 'tbay_framework_register_post_types', $types );
        if ( !empty($post_types) ) {
            foreach ($post_types as $post_type) {
                if ( file_exists( TBAY_FRAMEWORK_DIR . 'classes/post-types/'.$post_type.'.php' ) ) {
                    require TBAY_FRAMEWORK_DIR . 'classes/post-types/'.$post_type.'.php';
                }
            }
        }
    }
}

if( ! function_exists( 'tbay_framework_widget_init' ) ) {
    function tbay_framework_widget_init() {
        $widgets = apply_filters( 'tbay_framework_register_widgets', array() );
        if ( !empty($widgets) ) {
            foreach ($widgets as $widget) {
                if ( file_exists( TBAY_FRAMEWORK_DIR . 'classes/widgets/'.$widget.'.php' ) ) {
                    require TBAY_FRAMEWORK_DIR . 'classes/widgets/'.$widget.'.php';
                }
            }
        }

        if ( defined('TBAY_FRAMEWORK_WIDGETS_ACTIVED') && TBAY_FRAMEWORK_WIDGETS_ACTIVED ) {
            remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

            if(class_exists('Tbay_Widget_Custom_Menu')) {
                register_widget( 'Tbay_Widget_Custom_Menu' );
            }            

            if(class_exists('Tbay_Widget_Woo_Carousel')) {
                register_widget( 'Tbay_Widget_Woo_Carousel' );
            }        

            if(class_exists('Tbay_Widget_Popup_Newsletter')) {
                register_widget( 'Tbay_Widget_Popup_Newsletter' );
            }        

            if(class_exists('Tbay_Widget_Posts')) {
                register_widget( 'Tbay_Widget_Posts' );
            }        

            if(class_exists('Tbay_Widget_Recent_Comment')) {
                register_widget( 'Tbay_Widget_Recent_Comment' );
            }        

            if(class_exists('Tbay_Widget_Recent_Post')) {
                register_widget( 'Tbay_Widget_Recent_Post' );
            }        

            if(class_exists('Tbay_Widget_Single_Image')) {
                register_widget( 'Tbay_Widget_Single_Image' );
            }

            if(class_exists('Tbay_Widget_Socials_Widget')) {
                register_widget( 'Tbay_Widget_Socials_Widget' );
            }        

            if(class_exists('Tbay_Widget_Top_Rate_Widget')) {
                register_widget( 'Tbay_Widget_Top_Rate_Widget' );
            }        

            if(class_exists('Tbay_Widget_Featured_Video_Widget')) {
                register_widget( 'Tbay_Widget_Featured_Video_Widget' );
            }

            if(class_exists('PostRatings')) {
                register_widget( 'Tbay_Top_Rate_Widget' );
            }

            if(class_exists('Tbay_Widget_Template_Elementor')) {
                register_widget( 'Tbay_Widget_Template_Elementor' );
            }
        }
    }
}

if( ! function_exists( 'tbay_framework_get_widget_locate' ) ) {
    function tbay_framework_get_widget_locate( $name, $plugin_dir = TBAY_FRAMEWORK_DIR ) {
        $template = '';
        
        // Child theme
        if ( ! $template && ! empty( $name ) && file_exists( get_stylesheet_directory() . "/widgets/{$name}" ) ) {
            $template = get_stylesheet_directory() . "/widgets/{$name}";
        }

        // Original theme
        if ( ! $template && ! empty( $name ) && file_exists( get_template_directory() . "/widgets/{$name}" ) ) {
            $template = get_template_directory() . "/widgets/{$name}";
        }

        // Plugin
        if ( ! $template && ! empty( $name ) && file_exists( $plugin_dir . "/templates/widgets/{$name}" ) ) {
            $template = $plugin_dir . "/templates/widgets/{$name}";
        }

        // Nothing found
        if ( empty( $template ) ) {
            throw new Exception( "Template /templates/widgets/{$name} in plugin dir {$plugin_dir} not found." );
        }

        return $template;
    }
}

if( ! function_exists( 'tbay_framework_display_svg_image' ) ) {
    function tbay_framework_display_svg_image( $url, $class = '', $wrap_as_img = true, $attachment_id = null ) {
        if ( ! empty( $url ) && is_string( $url ) ) {

            // we try to inline svgs
            if ( substr( $url, - 4 ) === '.svg' ) {

                //first let's see if we have an attachment and inline it in the safest way - with readfile
                //include is a little dangerous because if one has short_open_tags active, the svg header that starts with <? will be seen as PHP code
                if ( ! empty( $attachment_id ) && false !== @readfile( get_attached_file( $attachment_id ) ) ) {
                    //all good
                } elseif ( false !== ( $svg_code = get_transient( md5( $url ) ) ) ) {
                    //now try to get the svg code from cache
                    echo $svg_code;
                } else {

                    //if not let's get the file contents using WP_Filesystem
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );

                    WP_Filesystem();

                    global $wp_filesystem;
                    
                    $svg_code = $wp_filesystem->get_contents( $url );

                    if ( ! empty( $svg_code ) ) {
                        set_transient( md5( $url ), $svg_code, 12 * HOUR_IN_SECONDS );

                        echo $svg_code;
                    }
                }

            } elseif ( $wrap_as_img ) {

                if ( ! empty( $class ) ) {
                    $class = ' class="' . $class . '"';
                }

                echo '<img src="' . $url . '"' . $class . ' alt="" />';

            } else {
                echo $url;
            }
        }
    }
}

if( ! function_exists( 'tbay_framework_get_file_contents' ) ) {
    function tbay_framework_get_file_contents($url, $use_include_path, $context) {
        return @file_get_contents($url, false, $context);
    }
}

if( ! function_exists( 'tbay_framework_remove_image_srcset' ) ) {
    function tbay_framework_remove_image_srcset( $media_item ) {
        add_filter( 'wp_calculate_image_srcset', '__return_false' );
    }
    add_action( 'init', 'tbay_framework_remove_image_srcset', 10 );
}


if ( !function_exists( 'tbay_framework_fix_customize_image_wvs_support' ) ) {
    function tbay_framework_fix_customize_image_wvs_support(){
        remove_filter( 'pre_update_option_woocommerce_thumbnail_image_width', 'wvs_clear_transient' );
        remove_filter( 'pre_update_option_woocommerce_thumbnail_cropping', 'wvs_clear_transient' );
    }
    add_action('admin_init', 'tbay_framework_fix_customize_image_wvs_support', 10);
}