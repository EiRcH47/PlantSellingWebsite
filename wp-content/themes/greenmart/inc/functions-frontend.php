<?php

if ( ! function_exists( 'greenmart_tbay_category' ) ) {
	function greenmart_tbay_category( $post ) {
		// format
		echo '<span class="category "> ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . esc_url(get_category_link( $categories->term_id )) . '" class="categories-name"><i class="fa fa-bar-chart"></i>' . esc_html($categories->name) . '</a>';
			} else {
				echo '<a href="' . esc_url(get_category_link( $categories->term_id )) . '" class="categories-name"><i class="fa fa-bar-chart"></i>' . esc_html($categories->name) . ', </a>';
			}
		}
		echo '</span>';
	}
}

if ( ! function_exists( 'greenmart_tbay_center_meta' ) ) {
	function greenmart_tbay_center_meta( $post ) {
		echo '<div class="entry-meta">';
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		
			echo "<div class='entry-create'>";
			echo "<span class='entry-date'>". get_the_date( 'M d, Y' ).'</span>';
			"<span class='author'>". esc_html_e('/ By ', 'greenmart'); the_author_posts_link() .'</span>';
			echo '</div>';
		echo '</div>';
	}
}



if ( ! function_exists( 'greenmart_tbay_full_top_meta' ) ) {
	function greenmart_tbay_full_top_meta( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<header class="entry-header-top ' . esc_attr($header_class) . '">';
		if(!is_single()){
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		// details
		$id = get_the_author_meta( 'ID' );
		echo '<span class="entry-profile"><span class="col"><span class="entry-author-link"><strong>' . esc_html__( 'By:', 'greenmart' ) . '</strong><span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url( $id )) . '" rel="author">' . get_the_author() . '</a></span></span><span class="entry-date"><strong>Posted: </strong>' . esc_html( get_the_date( 'M jS, Y' ) ) . '</span></span></span>';
		// comments
		echo '<span class="entry-categories"><strong>'. esc_html__('In:', 'greenmart') .'</strong> ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . esc_url(get_category_link( $categories->term_id )) . '" class="categories-name">' . esc_html($categories->name) . '</a>';
			} else {
				echo '<a href="' . esc_url(get_category_link( $categories->term_id )) . '" class="categories-name">' . esc_html($categories->name) . ', </a>';
			}
		}
		echo '</span>';
		if ( ! is_search() ) {
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="entry-comments-link">';
				comments_popup_link( esc_html__( '0', 'greenmart' ), esc_html__( '1', 'greenmart' ), esc_html__( '%', 'greenmart' ) );
				echo '</span>';
			}
		}
		echo '</header>';
	}
}

if ( ! function_exists( 'greenmart_tbay_post_tags' ) ) {
	function greenmart_tbay_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><span class="icon" rel=""></span> ';
			
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . esc_url(get_tag_link( $tag->term_id )) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
			}
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'greenmart_tbay_post_format_link_helper' ) ) {
	function greenmart_tbay_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = greenmart_tbay_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . esc_html($title) . '</h2>';
		$out['content'] = $content;

		return $out;
	}
}

if ( ! function_exists( 'greenmart_tbay_show_title_page' ) ) {
	function greenmart_tbay_show_title_page() {
		global $post;
		$title = '';
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'tbay_page_show_title', true );

			if(greenmart_tbay_is_home_page()) {
				$title = '';
			} else if ( isset($show) && $show == 'no' ) {
				$title = '';
			} else {
				$show_breadcrumb = get_post_meta( $post->ID, 'tbay_page_show_breadcrumb', true );
				if(isset($show_breadcrumb) && $show_breadcrumb == 'no') {
					$title = the_title( '<header class="page-header none-breadcrumb"><h1 class="page-title">', '</h1></header>' );
				} else {
					$title = the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header>' );
				}
			}	

		}
		
		return $title;
	}
}

if ( ! function_exists( 'greenmart_tbay_breadcrumbs' ) ) {
	function greenmart_tbay_breadcrumbs() {

		$delimiter = '';
		$home = esc_html__('Home', 'greenmart');
		$before = '<li class="active">';
		$after = '</li>';
		$title = '';
		if (!is_home() && !is_front_page() || is_paged()) {

			echo '<ol class="breadcrumb">';

			global $post;
			$homeLink = esc_url( home_url() );
			echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . esc_html($delimiter) . '</li> ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo trim($before) . single_cat_title('', false) . $after;
				$title = single_cat_title('', false);
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_time('d') . $after;
				$title = get_the_time('d');
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_time('F') . $after;
				$title = get_the_time('F');
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . esc_html($delimiter) . ' ';
					echo trim($before) . get_the_title() . $after;
					
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
					echo trim($before) . get_the_title() . $after;
				}
				$title = get_the_title();
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
					$title = $post_type->labels->singular_name;
				}
			}  elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); 
				if( isset($cat) && !empty($cat) ) {
				 $cat = $cat[0];
				 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				}
				echo '<li><a href="' . esc_url( get_permalink($parent->ID) ) . '">' . esc_html($parent->post_title) . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_title() . $after;
				$title = get_the_title();
			   } elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . get_the_title() . $after;
				$title = get_the_title();

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo trim($crumb) . ' ' . $delimiter . ' ';
				echo trim($before) . get_the_title() . $after;
				$title = get_the_title();
			} elseif ( is_search() ) {
				echo trim($before) . esc_html__('Search results for "','greenmart')  . get_search_query() . '"' . $after;
				$title = esc_html__('Search results for "','greenmart')  . get_search_query();
			} elseif ( is_tag() ) {
				echo trim($before) . esc_html__('Posts tagged "', 'greenmart'). single_tag_title('', false) . '"' . $after;
				$title = esc_html__('Posts tagged "', 'greenmart'). single_tag_title('', false) . '"';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by ', 'greenmart') . $userdata->display_name . $after;
				$title = esc_html__('Articles posted by ', 'greenmart') . $userdata->display_name;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'greenmart') . $after;
				$title = esc_html__('Error 404', 'greenmart');
			}

			echo '</ol>';
		}
	}
}

if ( ! function_exists( 'greenmart_tbay_render_breadcrumbs' ) ) {
	function greenmart_tbay_render_breadcrumbs() {
		global $post;

		$show = true;
		$img = $breadcrumb_class = '';
		$style = array();
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'tbay_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'tbay_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'tbay_page_breadcrumb_color', true );
			$style = array();
			if( $bgcolor  ){
				$style[] = 'background-color:'.$bgcolor;
			}
			if( $bgimage  ){ 
				$img = ' <img src="'.esc_url($bgimage).'">  ';
			}

		} elseif ( is_singular('post') || is_category() || is_home() || is_tag() || is_author() || is_day() || is_month() || is_year()  || is_search() ) {
			$show = greenmart_tbay_get_config('show_blog_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = greenmart_tbay_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = greenmart_tbay_get_config('blog_breadcrumb_color');
	        $style = array();
	        if( $breadcrumb_color  ){
	            $style[] = 'background-color:'.$breadcrumb_color;
				$breadcrumb_class .= ' breadcrumb-color';
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $img = ' <img src="'.$breadcrumb_img['url'].'">  ';
				$breadcrumb_class .= ' breadcrumb-img';
	        }
		}
		
		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		echo '<section id="tbay-breadscrumb" class="tbay-breadscrumb '. $breadcrumb_class .' "'.$estyle.'>'. ($img) .'<div class="container"><div class="p-relative breadscrumb-inner">';
			greenmart_tbay_breadcrumbs();
		echo '</div></div></section>';
	}
}

if ( !function_exists( 'greenmart_tbay_print_style_footer' ) ) {
	function greenmart_tbay_print_style_footer() {
    	$footer = greenmart_tbay_get_footer_layout();
    	if ( $footer ) {
    		$args = array(
				'name'        => $footer,
				'post_type'   => 'tbay_footer',
				'post_status' => 'publish',
				'numberposts' => 1
			);
			$posts = get_posts($args);
			foreach ( $posts as $post ) {
	    		return get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
	 	 	}
    	}
	}
  	add_action('wp_head', 'greenmart_tbay_print_style_footer', 18);
}

if ( ! function_exists( 'greenmart_tbay_paging_nav' ) ) {
	function greenmart_tbay_paging_nav() {
		global $wp_query, $wp_rewrite;
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '&larr; Previous', 'greenmart' ),
			'next_text' => esc_html__( 'Next &rarr;', 'greenmart' ),
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'greenmart' ); ?></h1>
			<div class="tbay-pagination">
				<?php echo trim($links); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'greenmart_tbay_post_nav' ) ) {
	function greenmart_tbay_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'greenmart' ); ?></h3>
			<div class="nav-links clearfix">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link','<div class="col-lg-6"><span class="meta-nav">'. esc_html__('Published In', 'greenmart').'</span></div>');
				else :
					previous_post_link( '%link','<div class="pull-left"><span class="meta-nav">'. esc_html__('Previous Post', 'greenmart').'</span></div>' );
					next_post_link( '%link', '<div class="pull-right"><span class="meta-nav">' . esc_html__('Next Post', 'greenmart').'</span><span></span></div>');
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if (!function_exists('greenmart_tbay_get_id_author_post') ) {
	function greenmart_tbay_get_id_author_post() {
		global $post;

		$author_id = $post->post_author;

		if( isset($author_id) ) {
			return $author_id;
		}
	}
}


if ( ! function_exists( 'greenmart_tbay_post_info_author' ) ) {
	function greenmart_tbay_post_info_author() { 
		$author_id = greenmart_tbay_get_id_author_post();

		?>
		<div class="author-info">
			<div class="avarta">
				<?php echo get_avatar($author_id, 90); ?>
			</div>
			<div class="content">
				<h4 class="name"><?php echo get_the_author(); ?></h4>
				<p><?php the_author_meta( 'description', $author_id ) ?></p>
				<a href="<?php echo get_author_posts_url($author_id); ?>" class="all-post"><?php esc_html_e('See all author post ', 'greenmart'); ?><?php echo  '<i class="tb-icon tb-icon-zt-chevron-right"></i>' ?></a>
			</div>
		</div>
		<?php
	}
}

if ( !function_exists('greenmart_tbay_pagination') ) {
    function greenmart_tbay_pagination($per_page, $total, $max_num_pages = '') {
    	global $wp_query, $wp_rewrite;
        ?>
        <div class="tbay-pagination">
        	<?php
        	$prev = esc_html__('Previous','greenmart');
        	$next = esc_html__('Next','greenmart');
        	$pages = $max_num_pages;
        	$args = array('class'=>'pull-left');

        	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	        if ( empty($pages) ) {
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if ( !$pages ) {
	                $pages = 1;
	            }
	        }
	        $pagination = array(
	            'base' => @add_query_arg('paged','%#%'),
	            'format' => '',
	            'total' => $pages,
	            'current' => $current,
	            'prev_text' => $prev,
	            'next_text' => $next,
	            'type' => 'array'
	        );

	        if( $wp_rewrite->using_permalinks() ) {
	            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	        }
	        
	        if ( isset($_GET['s']) ) {
	            $cq = $_GET['s'];
	            $sq = str_replace(" ", "+", $cq);
	        }
	        
	        if ( !empty($wp_query->query_vars['s']) ) {
	            $pagination['add_args'] = array( 's' => $sq);
	        }
	        $paginations = paginate_links( $pagination );
	        if ( !empty($paginations) ) {
	            echo '<ul class="pagination '.esc_attr( $args["class"] ).'">';
	                foreach ($paginations as $key => $pg) {
	                    echo '<li>'. esc_html($pg) .'</li>';
	                }
	            echo '</ul>';
	        }
        	?>
            
        </div>
    <?php
    }
}

if ( !function_exists('greenmart_tbay_comment_form') ) {
	function greenmart_tbay_comment_form($arg, $class = 'btn-primary btn-outline ') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform row reset-button-default">
		    	<div class="col-sm-12">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.esc_attr($class).'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('greenmart_tbay_list_comment') ) {
	function greenmart_tbay_list_comment($comment, $args, $depth) {
		if ( is_file(get_template_directory().'/list_comments.php') ) {
	        require get_template_directory().'/list_comments.php';
      	}
	}
}

if (!function_exists('greenmart_get_elementor_css_print_method') ) {
	function greenmart_get_elementor_css_print_method() {
		if( 'internal' !== get_option( 'elementor_css_print_method' ) ) {
			return false;
		} else {
			return true;
		}
	}
}

if (!function_exists('greenmart_tbay_display_header_builder') ) {
	function greenmart_tbay_display_header_builder() {
		echo greenmart_get_display_header_builder();
	}
}

if (!function_exists('greenmart_get_display_header_builder') ) {
	function greenmart_get_display_header_builder() {
		$id = greenmart_get_header_id();

		return  greenmart_get_html_custom_post($id);
	}
}

if (!function_exists('greenmart_get_header_id') ) {
	function greenmart_get_header_id() {
		$header 	= apply_filters( 'greenmart_tbay_get_header_layout', 'default' );

		$args = array(
			'name'		 => $header,
			'post_type'   => 'tbay_header',
			'post_status' => 'publish',
			'numberposts' => 1
		);
 
		$posts = get_posts($args);  

		return  ( !empty($posts[0]->ID) ) ? $posts[0]->ID : '';
	}
}

if (!function_exists('greenmart_get_footer_id') ) {
	function greenmart_get_footer_id() {
		global $footer_builder;
		$footer_builder = true;
		$footer 		= apply_filters( 'greenmart_tbay_get_footer_layout', 'default' );

		$args = array(
			'name'        => $footer,
			'post_type'   => 'tbay_footer',
			'post_status' => 'publish',
			'numberposts' => 1
		);

		$posts = get_posts($args); 

        return  ( !empty($posts[0]->ID) ) ? $posts[0]->ID : '';
	}
}

if (!function_exists('greenmart_get_display_footer_builder') ) {
	function greenmart_get_display_footer_builder() {
		$id = greenmart_get_footer_id();
		
		return  greenmart_get_html_custom_post($id);
	}
}

if (!function_exists('greenmart_tbay_display_footer_builder') ) {
	function greenmart_tbay_display_footer_builder() {
		echo greenmart_get_display_footer_builder();
	}
}

if( ! function_exists( 'greenmart_get_html_custom_post' ) ) {
	function greenmart_get_html_custom_post($id) { 
        if( is_null($id) || empty($id) ) return;
        
        $post = get_post( $id );

        if ( greenmart_elementor_is_activated() && Elementor\Plugin::instance()->documents->get( $id )->is_built_with_elementor() ) {
            return Elementor\Plugin::instance()->frontend->get_builder_content_for_display($id, greenmart_get_elementor_css_print_method());
        } else { 
            return do_shortcode($post->post_content);
        }
	}

}

if ( ! function_exists( 'greenmart_tbay_post_share_box' ) ) {
  function greenmart_tbay_post_share_box() {
		if( greenmart_elementor_is_edit_mode() || greenmart_elementor_is_preview_page() || greenmart_elementor_is_preview_mode() ) return;
      	if ( greenmart_tbay_get_config('enable_code_share',false) && greenmart_tbay_get_config('show_blog_social_share', true) ) {
          ?>
			<?php if( greenmart_tbay_get_config('select_share_type') == 'custom' ) : ?>
                <div class="tbay-post-share">
                    <?php  
                        $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        greenmart_custom_share_code( get_the_title(), get_permalink(), $image );
                    ?>
                </div>
            <?php else: ?>
                <div class="tbay-post-share">
                    <div class="addthis_inline_share_toolbox"></div>
                </div>
            <?php endif; ?>
          <?php
      }
  }
}

if ( !function_exists( 'greenmart_tbay_enqueue_media' ) ) {
 	function greenmart_tbay_enqueue_media () {
		wp_enqueue_media();
 	}
 	add_action('admin_enqueue_scripts', 'greenmart_tbay_enqueue_media');
}

if (!function_exists('greenmart_tbay_header_bodyclasses') ) {
	function greenmart_tbay_header_bodyclasses( $classes ) {

		$tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type', 'v1') );

		$classes[] = $tbay_header;

	    return $classes;
	}
	add_filter( 'body_class','greenmart_tbay_header_bodyclasses' );
}

if (!function_exists('greenmart_tbay_get_random_blog_cat') ) {
	function greenmart_tbay_get_random_blog_cat() {
		$post_category = "";
		$categories = get_the_category();

		$number = rand(0, count($categories) - 1);

		if($categories){

			$post_category .= '<a href="'.esc_url( get_category_link( $categories[$number]->term_id ) ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'greenmart' ), $categories[$number]->name ) ) . '">'.$categories[$number]->cat_name.'</a>';
		}  

		echo trim($post_category);
	}
}

if ( ! function_exists( 'greenmart_tbay_get_menu_mobile_icon' ) ) {
	function greenmart_tbay_get_menu_mobile_icon( $ouput) {

		$menu_option            = apply_filters( 'greenmart_menu_mobile_option', 10 );

		$ouput = '';
		if( $menu_option == 'smart_menu' ) {

			$ouput 	.= '<a href="#tbay-mobile-menu-navbar" class="btn btn-sm btn-danger">';
			$ouput  .= '<i class="'.greenmart_get_icon('icon_menu_mobile').'"></i>';
			$ouput  .= '</a>';			

			$ouput 	.= '<a href="#page" class="btn btn-sm btn-danger">';
			$ouput  .= '<i class="fa fa-close"></i>';
			$ouput  .= '</a>';
 
		} 
		else {
			$canvas_class = 'menu-canvas-click';
			$canvas_class .= ( greenmart_tbay_get_config('enable_ajax_canvas_menu', false) ) ? ' ajax-active' : '';

			$ouput 	.= '<button data-toggle="offcanvas" class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas '. esc_attr($canvas_class) .'" type="button" data-id="tbay-mobile-menu"><i class="fa fa-bars"></i></button>';
			
		}

		return $ouput;

	}

	add_filter( 'greenmart_get_menu_mobile_icon', 'greenmart_tbay_get_menu_mobile_icon',99 );
}

if ( ! function_exists( 'greenmart_tbay_woocs_redraw_cart' ) ) {
    function greenmart_tbay_woocs_redraw_cart() {
        return 0;
    }
    add_filter( 'woocs_redraw_cart', 'greenmart_tbay_woocs_redraw_cart', 10 ,1 );
}

if( ! function_exists('greenmart_load_html_dropdowns_action') ) {
	function greenmart_load_html_dropdowns_action() {
		$response = array(
			'status' => 'error',
			'message' => 'Can\'t load HTML blocks with AJAX',
			'data' => array(),
		); 

		if( greenmart_vc_is_activated() ) {
            WPBMap::addAllMappedShortcodes();
        }

		if( isset( $_POST['ids'] ) && is_array( $_POST['ids'] ) ) {
			$ids = greenmart_clean( $_POST['ids'] ); 
			foreach ($ids as $id) {   
				$id = (int) $id;
				if( isset( $_POST['format'] ) && $_POST['format'] === 'no-builder' ) {
					$post = get_post($id);      
					 
					$content = do_shortcode( $post->post_content );
				} else {
					$content = greenmart_get_html_custom_post($id);
				}

				if( ! $content ) continue;

				$response['status'] = 'success';
				$response['message'] = 'At least one HTML block loaded';
				$response['data'][$id] = $content;
			}
		}    

		echo json_encode($response);

		die();
	}
	add_action( 'wp_ajax_greenmart_load_html_dropdowns', 'greenmart_load_html_dropdowns_action' );
	add_action( 'wp_ajax_nopriv_greenmart_load_html_dropdowns', 'greenmart_load_html_dropdowns_action' );
}

if( ! function_exists('greenmart_load_html_click_action') ) {
	function greenmart_load_html_click_action() {
		$response = array(
			'status' => 'error',
			'message' => 'Can\'t load HTML blocks with AJAX',
			'data' => array(),
		);
   

		if( ! empty( $_POST['slug'] ) ) {
			$slug 			    = greenmart_clean( $_POST['slug'] );
			$layout 		    = greenmart_clean( $_POST['layout'] );
			$header_type 		= greenmart_clean( $_POST['header_type'] );

            $args = [
                'echo'        => false,
                'menu'        => $slug, 
                'container_class' => 'collapse navbar-collapse',
                'menu_id'     => 'menu-' . $slug,
                'walker'      => new greenmart_Tbay_Nav_Menu(),
                'fallback_cb' => '__return_empty_string',
                'container'   => '', 
                'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $slug .'">%3$s</ul>',
            ];   

			$args['menu_class'] = greenmart_nav_menu_get_menu_class($layout, $header_type); 

            $content = wp_nav_menu($args);     

            $response['status']     = 'success';
            $response['message']    = 'At least one HTML Menu Canvas loaded';
            $response['data']       = $content;
		}

		echo json_encode($response);

		die();
	}
	add_action( 'wp_ajax_greenmart_load_html_click', 'greenmart_load_html_click_action' );
	add_action( 'wp_ajax_nopriv_greenmart_load_html_click', 'greenmart_load_html_click_action' );
}

if( ! function_exists('greenmart_load_html_canvas_click_action') ) {
	function greenmart_load_html_canvas_click_action() {
		$response = array(
			'status' => 'error',
			'message' => 'Can\'t load HTML blocks with AJAX',
			'data' => array(),
		);

		if( ! empty( $_POST['slug'] ) ) {
			$slug 			    = greenmart_clean( $_POST['slug'] ); 
			$layout 			= greenmart_clean( $_POST['layout'] ); 
			$menu_id 			= greenmart_clean( $_POST['menu_id'] ); 
  
            $args = [
                'echo'        => false,
                'menu'        => $slug, 
                'container_class' => 'collapse navbar-collapse',
                'menu_id'     => $menu_id,
                'walker'      => new greenmart_Tbay_Nav_Menu(),
                'fallback_cb' => '__return_empty_string',
                'container'   => '', 
                'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $slug .'">%3$s</ul>',
            ];              
  
			if( $layout === 'treeview' ) {
				$args['menu_class']         =   'menu treeview nav navbar-nav';
			} else {
				$args['menu_class'] 		= 'nav navbar-nav';
			}

            $content = wp_nav_menu($args);     

            $response['status']     = 'success';
            $response['message']    = 'At least one HTML Menu Canvas loaded';
            $response['data']       = $content;
		}

		echo json_encode($response);

		die();
	}
	add_action( 'wp_ajax_greenmart_load_html_canvas_click', 'greenmart_load_html_canvas_click_action' );
	add_action( 'wp_ajax_nopriv_greenmart_load_html_canvas_click', 'greenmart_load_html_canvas_click_action' );
}

if ( ! function_exists( 'greenmart_get_social_html' ) ) {
	function greenmart_get_social_html($key, $value, $title, $link, $media) {
		if( !$value ) return;

		switch ($key) {
			case 'facebook':
				$output = sprintf(
					'<a class="share-facebook greenmart-facebook" title="%s" href="http://www.facebook.com/sharer.php?u=%s&t=%s" target="_blank"><i class="fa fa-facebook"></i></a>',
					esc_attr( $title ),
					urlencode( $link ),
					urlencode( $title )
				);
				break;			
			case 'twitter':
				$output = sprintf(
					'<a class="share-twitter greenmart-twitter" href="http://twitter.com/share?text=%s&url=%s" title="%s" target="_blank"><i class="fa fa-twitter"></i></a>',
					esc_attr( $title ),
					urlencode( $link ),
					urlencode( $title )
				);
				break;			
			case 'linkedin':
				$output = sprintf(
					'<a class="share-linkedin greenmart-linkedin" href="http://www.linkedin.com/shareArticle?url=%s&title=%s" title="%s" target="_blank"><i class="fa fa-linkedin"></i></a>',
					urlencode( $link ),
					esc_attr( $title ),
					urlencode( $title )
				);
				break;			

			case 'pinterest':
				$output = sprintf(
					'<a class="share-pinterest greenmart-pinterest" href="http://pinterest.com/pin/create/button?media=%s&url=%s&description=%s" title="%s" target="_blank"><i class="fa fa-pinterest-p"></i></a>',
					urlencode( $media ),
					urlencode( $link ),
					esc_attr( $title ),
					urlencode( $title )
				);
				break;			

			case 'whatsapp':
				$output = sprintf(
					'<a class="share-whatsapp greenmart-whatsapp" href="https://api.whatsapp.com/send?text=%s" title="%s" target="_blank"><i class="fa fa-whatsapp"></i></a>',
					urlencode( $link ),
					esc_attr( $title )
				);
				break;

			case 'email':
				$output = sprintf(
					'<a class="share-email greenmart-email" href="mailto:?subject=%s&body=%s" title="%s" target="_blank"><i class="fa fa-envelope-o"></i></a>',
					esc_html( $title ),
					urlencode( $link ),
					esc_attr( $title )
				);
				break;
			
			default:
				# code...
				break;
		}

		return $output;
	}
}

if ( ! function_exists( 'greenmart_custom_share_code' ) ) {
	function greenmart_custom_share_code( $title, $link, $media ) {
		if( !greenmart_tbay_get_config('enable_code_share', true) ) return;

		if( !is_singular( 'post') && !is_singular( 'product' ) ) return;

		$socials = greenmart_tbay_get_config('sortable_sharing');

		$socials_html = '';
		foreach ($socials as $key => $value) {
			$socials_html .= greenmart_get_social_html($key, $value, $title, $link, $media);
		}


		if ( $socials_html ) {
			$socials_html = apply_filters('greenmart_addons_share_link_socials', $socials_html);
			printf( '<div class="greenmart-social-links">%s</div>', $socials_html );
		}

	}
}

if ( ! function_exists( 'greenmart_tbay_get_title_mobile' ) ) {
    function greenmart_tbay_get_title_mobile( $title = '') {

        if ( ( greenmart_is_woocommerce_activated() && is_product_category() ) || is_category() ) {
            $title = single_cat_title();
        }  else if ( is_search() ) {
            $title   = sprintf( esc_html__( 'Search results for "%s"', 'greenmart' ), get_search_query() );
        } else if ( is_tag() ) {
            $title   = sprintf( esc_html__( 'Posts tagged "%s"', 'greenmart' ), single_tag_title('', false) );
        }else if ( greenmart_is_woocommerce_activated() && is_product_tag() ) {
            $title   = sprintf( esc_html__( 'Products tagged "%s"', 'greenmart' ), single_tag_title('', false) );
        } else if ( is_author() ) { 
            global $author;
            $userdata = get_userdata($author);
            $title = esc_html__('Articles posted by ', 'greenmart') . $userdata->display_name;
        } else if ( is_404() ) {  
            $title = esc_html__('Error 404', 'greenmart');
        } else if( greenmart_is_woocommerce_activated() && is_shop () ) {
            $title = esc_html__('shop','greenmart');
        } elseif( is_archive() ) {
			$title = single_cat_title("", false);
		} else {
            $title = get_the_title();
        }

        return $title;
    }
    add_filter( 'greenmart_get_filter_title_mobile', 'greenmart_tbay_get_title_mobile', 10, 1 );
}

if ( ! function_exists( 'greenmart_get_elementor_scripts' ) ) {
	function greenmart_get_elementor_scripts() {
		if( !greenmart_elementor_is_activated() ) return;

		$current_theme 	= greenmart_tbay_get_theme();
		
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}
	
		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$elementor_pro = \ElementorPro\Plugin::instance();
			$elementor_pro->enqueue_styles();
		}    
		
		if( $current_theme === 'organic-el' || $current_theme === 'fresh-el' ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$header_css_file = new \Elementor\Core\Files\CSS\Post( greenmart_get_header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$header_css_file = new \Elementor\Post_CSS_File( greenmart_get_header_id() );
			}
		
			$header_css_file->enqueue();
		}

		
		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$footer_css_file = new \Elementor\Core\Files\CSS\Post( greenmart_get_footer_id() );
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
			$footer_css_file = new \Elementor\Post_CSS_File( greenmart_get_footer_id() );
		}
	
		$footer_css_file->enqueue();

	}
} 