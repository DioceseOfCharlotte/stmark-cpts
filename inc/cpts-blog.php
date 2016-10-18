<?php
/**
 * Post Types.
 *
 * @package  RCstmark
 */

add_action( 'init', 'stmark_register_blog_cpts' );


/**
 * Register post_types.
 *
 * @since  0.1.0
 * @access public
 */
function stmark_register_blog_cpts() {

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'post-formats',
		'theme-layouts',
	);

	register_extended_post_type( 'bulletin',
		array(
			'supports' 		 	=> $supports,
			'hierarchical'   	=> false,
			'menu_icon'     	=> 'dashicons-megaphone',
			'capability_type' 	=> 'bulletin',
			'map_meta_cap'  	=> true,
			'capabilities' => stmark_posts_plugin()->stmark_get_capabilities( 'bulletin' ),
		array(
			'singular' => 'Bulletin',
		    'plural'   => 'Bulletins',
			'slug'     => 'bulletin-board',
		),
		)
	);

	register_extended_post_type( 'press_release',
		array(
			'supports' 		 	=> $supports,
			'hierarchical'   	=> false,
			'menu_icon'     	=> 'dashicons-welcome-widgets-menus',
			'capability_type' 	=> 'press_release',
			'map_meta_cap'  	=> true,
			'capabilities' => stmark_posts_plugin()->stmark_get_capabilities( 'press_release' ),
		array(
			'singular' => 'Press Release',
		    'plural'   => 'Press Releases',
			'slug'     => 'press_release',
		),
		)
	);

	register_extended_post_type( 'thursday_packet',
		array(
			'supports' 		 	=> $supports,
			'hierarchical'   	=> false,
			'menu_icon'     	=> 'dashicons-portfolio',
			'capability_type' 	=> 'thursday_packet',
			'map_meta_cap'  	=> true,
			'capabilities' => stmark_posts_plugin()->stmark_get_capabilities( 'thursday_packet' ),
		array(
			'singular' => 'Thursday packet',
		    'plural'   => 'Thursday packets',
			'slug'     => 'thursday_packet',
		),
		)
	);
}
