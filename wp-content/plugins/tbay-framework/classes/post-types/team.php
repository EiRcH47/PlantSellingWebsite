<?php
/**
 * mentor post type
 *
 * @package    tbay-framework
 * @author     TbayTheme <tbaythemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 TbayTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Tbay_PostType_Team{

	/**
	 * init action and filter data to define resource post type
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_action( 'init', array( __CLASS__, 'definition_taxonomy' ) );
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );

		add_action( 'admin_init', array( __CLASS__, 'add_role_caps' ) );
	}
	/**
	 *
	 */
	public static function definition() {
		
		$labels = array(
			'name'                  => __( 'Tbay Teams', 'tbay-framework' ),
			'singular_name'         => __( 'Team', 'tbay-framework' ),
			'add_new'               => __( 'Add New Team', 'tbay-framework' ),
			'add_new_item'          => __( 'Add New Team', 'tbay-framework' ),
			'edit_item'             => __( 'Edit Team', 'tbay-framework' ),
			'new_item'              => __( 'New Team', 'tbay-framework' ),
			'all_items'             => __( 'All Teams', 'tbay-framework' ),
			'view_item'             => __( 'View Team', 'tbay-framework' ),
			'search_items'          => __( 'Search Team', 'tbay-framework' ),
			'not_found'             => __( 'No Teams found', 'tbay-framework' ),
			'not_found_in_trash'    => __( 'No Teams found in Trash', 'tbay-framework' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Tbay Teams', 'tbay-framework' ),
		);

		$labels = apply_filters( 'tbay_framework_postype_mentor_labels' , $labels );

		$type = 'tbay_team';
		register_post_type( 'tbay_team',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'thumbnail' ),
				'show_in_rest' 		=> true, 
				'public'            => true,
				'has_archive'       => false,
				'rewrite'           => array( 'slug' => __( 'mentor', 'tbay-framework' ) ),
				'menu_position'     => 53,
				'categories'        => array(),
				'show_in_menu'  	=> true,
				'menu_icon'         => 'dashicons-welcome-widgets-menus',
				'capability_type'   => array($type,'{$type}s'),
				'map_meta_cap'      => true,	 
			)
		);
	}

	public static function definition_taxonomy() {
		$labels = array(
			'name'              => __( 'Team Categories', 'tbay-framework' ),
			'singular_name'     => __( 'Team Category', 'tbay-framework' ),
			'search_items'      => __( 'Search Team Categories', 'tbay-framework' ),
			'all_items'         => __( 'All Team Categories', 'tbay-framework' ),
			'parent_item'       => __( 'Parent Team Category', 'tbay-framework' ),
			'parent_item_colon' => __( 'Parent Team Category:', 'tbay-framework' ),
			'edit_item'         => __( 'Edit Team Category', 'tbay-framework' ),
			'update_item'       => __( 'Update Team Category', 'tbay-framework' ),
			'add_new_item'      => __( 'Add New Team Category', 'tbay-framework' ),
			'new_item_name'     => __( 'New Team Category', 'tbay-framework' ),
			'menu_name'         => __( 'Team Categories', 'tbay-framework' ),
		);

		register_taxonomy( 'tbay_team_category', 'tbay_team', array(
			'labels'            => apply_filters( 'tbay_framework_taxomony_team_category_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'team-category',
			'rewrite'           => array( 'slug' => __( 'team-category', 'tbay-framework' ) ),
			'public'            => true,
			'show_ui'           => true,
		) );
	}

	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = 'tbay_team_';
		
		$metaboxes[ $prefix . 'info' ] = array(
			'id'                        => $prefix . 'info',
			'title'                     => __( 'More Informations', 'tbay-framework' ),
			'object_types'              => array( 'tbay_team' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_info_fields()
		);
		
		return $metaboxes;
	}

	public static function metaboxes_info_fields() {
		$prefix = 'tbay_team_';
		$fields = array(
			array(
				'name'              => __( 'Job', 'tbay-framework' ),
				'id'                => $prefix . 'job',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Facebook', 'tbay-framework' ),
				'id'                => $prefix . 'facebook',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Twitter', 'tbay-framework' ),
				'id'                => $prefix . 'twitter',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Behance', 'tbay-framework' ),
				'id'                => $prefix . 'behance',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Linkedin', 'tbay-framework' ),
				'id'                => $prefix . 'linkedin',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Instagram', 'tbay-framework' ),
				'id'                => $prefix . 'instagram',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Google Plus', 'tbay-framework' ),
				'id'                => $prefix . 'google_plus',
				'type'              => 'text'
			),
			array(
				'name'              => __( 'Pinterest', 'tbay-framework' ),
				'id'                => $prefix . 'pinterest',
				'type'              => 'text'
			),
		);

		return apply_filters( 'tbay_framework_postype_tbay_team_metaboxes_fields' , $fields );
	}

	
	public static function add_role_caps() {
 
		// Add the roles you'd like to administer the custom post types
		$roles = array('administrator');

		$type  = 'tbay_team';
		
		// Loop through each role and assign capabilities
		foreach($roles as $the_role) { 
		
		   $role = get_role($the_role);
		
		   $role->add_cap( 'read' );
		   $role->add_cap( 'read_{$type}');
		   $role->add_cap( 'read_private_{$type}s' );
		   $role->add_cap( 'edit_{$type}' );
		   $role->add_cap( 'edit_{$type}s' );
		   $role->add_cap( 'edit_others_{$type}s' );
		   $role->add_cap( 'edit_published_{$type}s' );
		   $role->add_cap( 'publish_{$type}s' );
		   $role->add_cap( 'delete_others_{$type}s' );
		   $role->add_cap( 'delete_private_{$type}s' ); 
		   $role->add_cap( 'delete_published_{$type}s' );
		
		}
   }

}

Tbay_PostType_Team::init();