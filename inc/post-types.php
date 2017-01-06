<?php
/**
 * Post Types.
 *
 * @package  RCDOC
 */

add_action( 'init', 'stmark_register_post_types' );

/**
 * Register post_types.
 *
 * @since  0.1.0
 * @access public
 */
function stmark_register_post_types() {

	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'arch-post',
		'excerpt',
		'post-formats',
		'page-attributes',
		'theme-layouts',
		'archive',
	);

	register_extended_post_type( 'parent-home',
		array(
		'admin_cols' => array(
			'featured_image' => array(
				'title'          => 'Image',
				'featured_image' => 'abe-icon',
			),
		),
		'admin_filters' => array(
			'component' => array(
				'title'    => 'All block types',
				'meta_key' => 'arch_component',
			),
		),
		'menu_icon'           => 'dashicons-admin-users',
		'supports'            => $supports,
		'capability_type'     => 'parent-home',
		'map_meta_cap'        => true,
		'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'parent-home' ),
		)
	);

		register_extended_post_type( 'athletic',
			array(
			'admin_cols' => array(
				'featured_image' => array(
					'title'          => 'Image',
					'featured_image' => 'abe-icon',
				),
			),
			'admin_filters' => array(
		        'component' => array(
		            'title'    => 'All block types',
		            'meta_key' => 'arch_component',
		        ),
			),
			'menu_icon'           => 'dashicons-awards',
			'supports'            => $supports,
			'capability_type'     => 'athletic',
			'map_meta_cap'        => true,
			'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'athletic' ),
			)
		);

		register_extended_post_type( 'pto',
			array(
			'admin_cols' => array(
				'featured_image' => array(
					'title'          => 'Image',
					'featured_image' => 'abe-icon',
				),
			),
			'admin_filters' => array(
		        'component' => array(
		            'title'    => 'All block types',
		            'meta_key' => 'arch_component',
		        ),
			),
			'menu_icon'           => 'dashicons-clipboard',
			'supports'            => $supports,
			'capability_type'     => 'pto',
			'map_meta_cap'        => true,
			'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'pto' ),
			)
		);

		register_extended_post_type( 'academic',
			array(
			'admin_cols' => array(
				'featured_image' => array(
					'title'          => 'Image',
					'featured_image' => 'abe-icon',
				),
			),
			'admin_filters' => array(
		        'component' => array(
		            'title'    => 'All block types',
		            'meta_key' => 'arch_component',
		        ),
			),
			'menu_icon'           => 'dashicons-welcome-learn-more',
			'supports'            => $supports,
			'capability_type'     => 'academic',
			'map_meta_cap'        => true,
			'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'academic' ),
			)
		);

		register_extended_post_type( 'extracurricular',
			array(
			'admin_cols' => array(
				'featured_image' => array(
					'title'          => 'Image',
					'featured_image' => 'abe-icon',
				),
			),
			'admin_filters' => array(
		        'component' => array(
		            'title'    => 'All block types',
		            'meta_key' => 'arch_component',
		        ),
			),
			'menu_icon'           => 'dashicons-admin-customizer',
			'supports'            => $supports,
			'capability_type'     => 'extracurricular',
			'map_meta_cap'        => true,
			'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'extracurricular' ),
			)
		);

		register_extended_post_type( 'classroom',
			array(
			'admin_cols' => array(
				'grade' => array(
					'taxonomy' => 'classroom_grade',
				),
				'featured_image' => array(
					'title'          => 'Image',
					'featured_image' => 'abe-icon',
				)
			),
			'admin_filters' => array(
		        'component' => array(
		            'title'    => 'All block types',
		            'meta_key' => 'arch_component',
		        ),
			),
			'menu_icon'           => 'dashicons-editor-spellcheck',
			'supports'            => $supports,
			'capability_type'     => 'classroom',
			'map_meta_cap'        => true,
			'capabilities'        => stmark_posts_plugin()->stmark_get_capabilities( 'classroom' ),
			)
		);

		register_extended_taxonomy( 'classroom_grade', 'classroom',
			array(
			'capabilities' => array(
				'manage_terms' => 'manage_options',
				'edit_terms'   => 'manage_options',
				'delete_terms' => 'manage_options',
				'assign_terms' => 'edit_classrooms',
			),
			),
			array(
		    'singular' => 'Grade Level',
		    'plural'   => 'Grade Levels',
			)
		);

}


add_filter( 'hybrid_get_theme_layout', 'abe_landing_layout' );
add_filter( 'register_post_type_args', 'cpt_archive_labels', 10, 2 );

function abe_landing_layout( $layout ) {

	$archive_layout = '';
	if ( is_post_type_archive() ) {
		global $cptarchives;

		$archive_layout = hybrid_get_post_layout( $cptarchives->get_archive_id() );
	}
	return $archive_layout && 'default' !== $archive_layout ? $archive_layout : $layout;
}



function cpt_archive_labels( $args, $type ) {

	$cpt_archive_labels = array(
		'name'               => _x( 'Landing Pages', 'post type general name', 'cpt-archives' ),
		'singular_name'      => _x( 'Landing Page', 'post type singular name', 'cpt-archives' ),
		'menu_name'          => _x( 'Landing Pages', 'admin menu', 'cpt-archives' ),
		'name_admin_bar'     => _x( 'Landing Page', 'add new on admin bar', 'cpt-archives' ),
		'add_new'            => _x( 'Add New', 'cpt_archive', 'cpt-archives' ),
		'add_new_item'       => __( 'Add New Landing Page', 'cpt-archives' ),
		'new_item'           => __( 'New Landing Page', 'cpt-archives' ),
		'edit_item'          => __( 'Edit Landing Page', 'cpt-archives' ),
		'view_item'          => __( 'View Landing Page', 'cpt-archives' ),
		'all_items'          => __( 'All Landing Pages', 'cpt-archives' ),
		'search_items'       => __( 'Search Landing Pages', 'cpt-archives' ),
		'parent_item_colon'  => __( 'Parent Landing Pages:', 'cpt-archives' ),
		'not_found'          => __( 'No landing pages found.', 'cpt-archives' ),
		'not_found_in_trash' => __( 'No landing pages found in Trash.', 'cpt-archives' ),
	);

	if ( 'cpt_archive' === $type ) {
		$args['labels']   = $cpt_archive_labels;
		$args['supports'] = array(
			'author',
			'thumbnail',
			'theme-layouts',
			'custom-header',
		);
		$args['taxonomies']   = array( 'agency' );
	}

	return $args;
}
