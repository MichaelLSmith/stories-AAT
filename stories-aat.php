<?php
/**
* Plugin Name: stories-aat
* Description: A simple plugin that adds stories
* Version 0.1
* Author: Michael Laurence Smith
* License: GPL2
**/
/**
* CPT-videos is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
* CPT-videos is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
**/

//Custom taxonomy function disabled. Not sure if we'll need it.


if ( ! function_exists('create_stories_cpt') ) {

// Register Custom Post Type
function create_stories_cpt() {

	$labels = array(
		'name'                  => _x( 'Stories', 'Post Type General Name', 'and-also-too' ),
		'singular_name'         => _x( 'Story', 'Post Type Singular Name', 'and-also-too' ),
		'menu_name'             => __( 'Stories', 'and-also-too' ),
		'name_admin_bar'        => __( 'Stories', 'and-also-too' ),
		'archives'              => __( 'Stories Archive', 'and-also-too' ),
		'attributes'            => __( 'Story Attributes', 'and-also-too' ),
		'parent_item_colon'     => __( 'Parent Story:', 'and-also-too' ),
		'all_items'             => __( 'All Stories', 'and-also-too' ),
		'add_new_item'          => __( 'Add New Story', 'and-also-too' ),
		'add_new'               => __( 'Add New', 'and-also-too' ),
		'new_item'              => __( 'New Story', 'and-also-too' ),
		'edit_item'             => __( 'Edit Story', 'and-also-too' ),
		'update_item'           => __( 'Update Story', 'and-also-too' ),
		'view_item'             => __( 'View Story', 'and-also-too' ),
		'view_items'            => __( 'View Stories', 'and-also-too' ),
		'search_items'          => __( 'Search Story', 'and-also-too' ),
		'not_found'             => __( 'Not found', 'and-also-too' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'and-also-too' ),
		'featured_image'        => __( 'Featured Image', 'and-also-too' ),
		'set_featured_image'    => __( 'Set featured image', 'and-also-too' ),
		'remove_featured_image' => __( 'Remove featured image', 'and-also-too' ),
		'use_featured_image'    => __( 'Use as featured image', 'and-also-too' ),
		'insert_into_item'      => __( 'Insert into item', 'and-also-too' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'and-also-too' ),
		'items_list'            => __( 'Stories list', 'and-also-too' ),
		'items_list_navigation' => __( 'Stories list navigation', 'and-also-too' ),
		'filter_items_list'     => __( 'Filter items list', 'and-also-too' ),
	);
	$rewrite = array(
		'slug'                  => 'story',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Story', 'and-also-too' ),
		'description'           => __( 'Stories post type for AAT', 'and-also-too' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'stories', $args );

}
add_action( 'init', 'create_stories_cpt', 0 );

}


function and_also_too_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'and_also_too_add_custom_types' );


/**
 * Flush rewrite rules to make custom ULRs active
 */
function and_also_too_rewrite_flush() {
    create_stories_cpt(); //
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'and_also_too_rewrite_flush' );

/* Custom Taxonomies */

function custom_taxonomies(){

	/* Communities */
	$labels = array(
	'name'                       => _x( 'Communities', 'taxonomy general name', 'and_also_too' ),
	'singular_name'              => _x( 'Community', 'taxonomy singular name', 'and_also_too' ),
	'search_items'               => __( 'Search Communities', 'and_also_too' ),
	'popular_items'              => __( 'Popular Communities', 'and_also_too' ),
	'all_items'                  => __( 'All Communities', 'and_also_too' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Community', 'and_also_too' ),
	'update_item'                => __( 'Update Community', 'and_also_too' ),
	'add_new_item'               => __( 'Add New Community', 'and_also_too' ),
	'new_item_name'              => __( 'New Community Name', 'and_also_too' ),
	'separate_items_with_commas' => __( 'Separate Communities with commas', 'and_also_too' ),
	'add_or_remove_items'        => __( 'Add or remove Communities', 'and_also_too' ),
	'choose_from_most_used'      => __( 'Choose from the most used Communities', 'and_also_too' ),
	'not_found'                  => __( 'No Communities found.', 'and_also_too' ),
	'menu_name'                  => __( 'Communities', 'and_also_too' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'community' ),
	);

	register_taxonomy(
		//name of taxonomy
		'tax-community',
		//which post type it applies to:
		array('stories', 'post'),
		$args
	);


	/* Services */
	$labels = array(
	'name'                       => _x( 'Services', 'taxonomy general name', 'and_also_too' ),
	'singular_name'              => _x( 'Service', 'taxonomy singular name', 'and_also_too' ),
	'search_items'               => __( 'Search Services', 'and_also_too' ),
	'popular_items'              => __( 'Popular Services', 'and_also_too' ),
	'all_items'                  => __( 'All Services', 'and_also_too' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Service', 'and_also_too' ),
	'update_item'                => __( 'Update Service', 'and_also_too' ),
	'add_new_item'               => __( 'Add New Service', 'and_also_too' ),
	'new_item_name'              => __( 'New Service Name', 'and_also_too' ),
	'separate_items_with_commas' => __( 'Separate Services with commas', 'and_also_too' ),
	'add_or_remove_items'        => __( 'Add or remove Services', 'and_also_too' ),
	'choose_from_most_used'      => __( 'Choose from the most used Services', 'and_also_too' ),
	'not_found'                  => __( 'No Services found.', 'and_also_too' ),
	'menu_name'                  => __( 'Services', 'and_also_too' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'service' ),
	);

	register_taxonomy(
		//name of taxonomy
		'tax-service',
		//which post type it applies to:
		array('stories', 'post'),
		$args
	);

	/* People */
	$labels = array(
	'name'                       => _x( 'People', 'taxonomy general name', 'and_also_too' ),
	'singular_name'              => _x( 'Person', 'taxonomy singular name', 'and_also_too' ),
	'search_items'               => __( 'Search People', 'and_also_too' ),
	'popular_items'              => __( 'Popular People', 'and_also_too' ),
	'all_items'                  => __( 'All People', 'and_also_too' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Person', 'and_also_too' ),
	'update_item'                => __( 'Update Person', 'and_also_too' ),
	'add_new_item'               => __( 'Add New Person', 'and_also_too' ),
	'new_item_name'              => __( 'New Service Name', 'and_also_too' ),
	'separate_items_with_commas' => __( 'Separate People with commas', 'and_also_too' ),
	'add_or_remove_items'        => __( 'Add or remove Person', 'and_also_too' ),
	'choose_from_most_used'      => __( 'Choose from the most used People', 'and_also_too' ),
	'not_found'                  => __( 'No People found.', 'and_also_too' ),
	'menu_name'                  => __( 'People', 'and_also_too' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'people' ),
	);

	register_taxonomy(
		//name of taxonomy
		'tax-people',
		//which post type it applies to:
		array('stories', 'post'),
		$args
	);

}

add_action( 'init', 'custom_taxonomies');



 ?>
