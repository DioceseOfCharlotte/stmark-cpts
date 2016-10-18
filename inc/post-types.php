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
