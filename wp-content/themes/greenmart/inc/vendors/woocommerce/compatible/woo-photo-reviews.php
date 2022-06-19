<?php

if( !class_exists( 'VI_Woo_Photo_Reviews' ) ) return;


if (! function_exists('greenmart_woocommerce_photo_reviews_setup_support')) {
    add_action('after_setup_theme', 'greenmart_woocommerce_photo_reviews_setup_support', 20);
    function greenmart_woocommerce_photo_reviews_setup_support()
    {
        $ptreviews = greenmart_photo_reviews_thumbnail_image();
        add_image_size( 'greenmart_photo_reviews_thumbnail_image', $ptreviews['width'], $ptreviews['height'], $ptreviews['crop'] );
    }
}

if( ! function_exists('greenmart_photo_reviews_thumbnail_image')) {
    function greenmart_photo_reviews_thumbnail_image() {
        $thumbnail_cropping    	= get_option( 'greenmart_photo_reviews_thumbnail_image_cropping', 'yes');
        $cropping    			= ($thumbnail_cropping == 'yes') ? true : false;
    
        return array(
            'width'  => get_option( 'greenmart_photo_reviews_thumbnail_image_width', 100),
            'height' => get_option( 'greenmart_photo_reviews_thumbnail_image_height', 100),
            'crop'   => $cropping,
        );		
    }
}


if (! function_exists('greenmart_photo_reviews_reduce_array')) {
    add_filter('woocommerce_photo_reviews_reduce_array', 'greenmart_photo_reviews_reduce_array', 10 ,1);
    function greenmart_photo_reviews_reduce_array($reduce)
    { 
        array_push($reduce,'greenmart_photo_reviews_thumbnail_image');
        return $reduce;
    }
}

if( !function_exists('greenmart_get_photo_reviews_thumbnail_size') ) {
    add_filter( 'woocommerce_photo_reviews_thumbnail_photo', 'greenmart_get_photo_reviews_thumbnail_size', 10, 3 );
    function greenmart_get_photo_reviews_thumbnail_size($url, $image_post_id, $comment) {
        $img_src     = wp_get_attachment_image_src($image_post_id, 'greenmart_photo_reviews_thumbnail_image');
    
        return $img_src[0]; 
    }
}

if ( ! function_exists('greenmart_get_photo_reviews_large_size')) {
    add_filter( 'woocommerce_photo_reviews_large_photo', 'greenmart_get_photo_reviews_large_size', 10, 3 );
    function greenmart_get_photo_reviews_large_size($url, $image_post_id, $comment) {
        $img_src     = wp_get_attachment_image_src($image_post_id, 'full');
    
        return $img_src[0];
    }
}

if ( !function_exists('greenmart_the_list_images_review') ) {
    function greenmart_the_list_images_review() {
        global $product;
    
        if ( ! is_product() ) return;
        $skin = greenmart_tbay_get_theme();
    
        $product_title = $product->get_title();
        $product_single_layout  =   ( isset($_GET['product_single_layout']) )   ?   $_GET['product_single_layout'] :  greenmart_tbay_get_config('product_single_layout')  ;
        $args     = array(
            'post_type'    => 'product',
            'type'         => 'review',
            'status'       => 'approve',
            'post_id'      => $product->get_id(),
            'meta_key'     => 'reviews-images'
        );  
    
        $comments = get_comments( $args );
    
        if (is_array($comments) || is_object($comments)) {
            $outputs = '<div id="list-review-images">';
            
            $outputs_li = '';
    
            $i = 0;
            foreach ( $comments as $comment ) {
                $comment_id     = $comment->comment_ID;
                $image_post_ids = get_comment_meta($comment_id, 'reviews-images', true);
                $content        = get_comment( $comment_id )->comment_content;
                $author         = '<span class="author">'. get_comment( $comment_id )->comment_author .'</span>';
                $rating         = intval( get_comment_meta( $comment_id, 'rating', true ) );

                if ( $rating && wc_review_ratings_enabled() ) {
                    $rating_content = wc_get_rating_html( $rating );
                } else {
                    $rating_content = '';
                } 

                $caption = '<span class="header-comment">' . $rating_content . $author . '</span><span class="title-comment">'. $content .'</span>';
    
                if (is_array($image_post_ids) || is_object($image_post_ids)) {
                    foreach ( $image_post_ids as $image_post_id ) {
                        if ( ! wc_is_valid_url( $image_post_id ) ) {
                            $image_data = wp_get_attachment_metadata( $image_post_id );
                            $alt        = get_post_meta( $image_post_id, '_wp_attachment_image_alt', true );
                            $image_alt  = $alt ? $alt : $product_title;

                            $width 		= $image_data['width'];
                            $height 	= $image_data['height'];
    
                            $img_src = apply_filters( 'woocommerce_photo_reviews_thumbnail_photo', wp_get_attachment_thumb_url( $image_post_id ), $image_post_id, $comment );
    
                            $img_src_open = apply_filters( 'woocommerce_photo_reviews_large_photo', wp_get_attachment_thumb_url( $image_post_id ), $image_post_id, $comment );
    
                            $outputs_li .= '<li class="review-item"><a class="lightbox-gallery" data-caption="'. esc_attr($caption) .'" data-width="'. esc_attr($width) .'" data-height="'. esc_attr($height) .'"  href="'. esc_url($img_src_open) .'"><img class="review-images skip-lazy"
                            src="' . esc_url($img_src) .'" alt="'. apply_filters( 'woocommerce_photo_reviews_image_alt', $image_alt, $image_post_id, $comment ) .'"/></a></li>';
                            $i++; 
                        }
                    }
                }
            }  
    
            $more   = '';
            $more_i = $more_show = 0;

            if( $skin === 'fresh-el' && $i > 4) {
                $more_show  = 4;
                $more_i     = $i - $more_show;
                $more       = '<li class="more d-none d-xl-flex">';
                $more       .= '<span>'. $more_i .'+</span>';
                $more       .= '</li>';
            } else if( $skin === 'health' || $skin === 'flower' ) {
                if ( ($product_single_layout === 'left-main') || ($product_single_layout === 'main-right') ) {
                    $more_show   = 4; 
                    $more_i      = $i - $more_show;
                    $more        = '<li class="more d-none d-xl-flex">';
                    $more        .= '<span>'. $more_i .'+</span>';
                    $more        .= '</li>';
                } elseif ($i > 6) {
                    $more_show   = 6;
                    $more_i      = $i - $more_show;
                    $more        = '<li class="more d-none d-xl-flex">';
                    $more        .= '<span>'. $more_i .'+</span>';
                    $more        .= '</li>'; 
                }
            } else if ($i > 6) {
                if ( ($product_single_layout === 'left-main') || ($product_single_layout === 'main-right') ) {
                    $more_show   = 6; 
                    $more_i      = $i - $more_show;
                    $more        = '<li class="more d-none d-xl-flex">';
                    $more        .= '<span>'. $more_i .'+</span>';
                    $more        .= '</li>';
                } elseif ($i > 7) {
                    $more_show   = 7;
                    $more_i      = $i - $more_show;
                    $more        = '<li class="more d-none d-xl-flex">';
                    $more        .= '<span>'. $more_i .'+</span>';
                    $more        .= '</li>'; 
                }
            }  
    
            $outputs_li .= $more; 
    
            $outputs .= '<ul id="imageReview" class="collapse" data-show="'. esc_attr($more_show) .'">';
            $outputs .= $outputs_li;
            $outputs .= '</ul>';
            $outputs .= '<a data-toggle="collapse" href="#imageReview" class="toogle-img-review">'. $i . esc_html__(' Images from customers', 'greenmart') .'</a>';
            $outputs .= '</div>';
        } 
    
        if( $i === 0 ) {
            return;
        }
    
        echo trim($outputs);
    } 
    add_filter( 'woocommerce_before_single_product_summary', 'greenmart_the_list_images_review', 100 );
}