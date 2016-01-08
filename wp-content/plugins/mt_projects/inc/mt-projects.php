<?php

add_theme_support( 'post-thumbnails' ); 

include_once( $dir . 'inc/meta_box.php' ); 

// Hook into the 'init' action
add_action('init', 'create_mt_projects_post'); 


/**
 * Projects Post Type.
 */
function create_mt_projects_post() {

	$labels = array(
		'name'                => _x( 'Projects', 'Post Type General Name', 'mtprojects' ),
		'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'mtprojects' ),
		'menu_name'           => __( 'Projects', 'mtprojects' ),
		'parent_item_colon'   => __( 'Parent Item:', 'mtprojects' ),
		'all_items'           => __( 'All Projects', 'mtprojects' ),
		'view_item'           => __( 'View Project', 'mtprojects' ),
		'add_new_item'        => __( 'Add New Project', 'mtprojects' ),
		'add_new'             => __( 'Add New', 'mtprojects' ),
		'edit_item'           => __( 'Edit Project', 'mtprojects' ),
		'update_item'         => __( 'Update Project', 'mtprojects' ),
		'search_items'        => __( 'Search Projects', 'mtprojects' ),
		'not_found'           => __( 'Not found', 'mtprojects' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'mtprojects' ),
	);
	$args = array(
		'label'               => __( 'projects', 'mtprojects' ),
		'description'         => __( 'Add projects to your website.', 'mtprojects' ), 
		'labels'              => $labels,
		'supports' 			  => array('title','editor','thumbnail','comments'),
		'taxonomies'          => array( 'thumbnail', 'category' ),
		'hierarchical'        => false,
		'menu_icon' 		  => 'dashicons-hammer',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 43,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'project', $args );

}
 