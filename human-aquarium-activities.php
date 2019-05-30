<?php
/**
 * @package Human Aquarium Activities
 * @version 1.0
 */
/*
Plugin Name: Human Aquarium Activities
Plugin URI: http://suesdesign.co.uk/
Description: Activities for the Human Aquarium exhibition
Author: Sue Johnson
Version: 1.0
Author URI: http://suesdesign.co.uk/
*/

/*
 * register post type
*/

function ha_activities_register_post_type() {
	$labels = array( 
		'name'               => _x( 'Activities', 'ha_activities' ),
		'singular name'      => _x( 'Activity', 'ha_activities' ),
		'add_new'            => _x( 'Add new Activity', 'ha_activities' ),
		'add_new_item'       => __( 'Add new Activity', 'ha_activities' ),
		'edit_item'          => __( 'Edit Activity', 'ha_activities' ),
		'new_item'           => __( 'New Activity', 'ha_activities' ),
		'all_items'          => __( 'All Activities', 'ha_activities' ),
		'view_item'          => __( 'View Activity', 'ha_activities' ),
		'search_items'       => __( 'Search Activities', 'ha_activities' ),
		'not_found'          => __( 'No Activities', 'ha_activities' ),
		'not_found_in_trash' => __( 'No Activities found in trash', 'ha_activities' )
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	
	register_post_type( 'ha_activities', $args );
}

add_action( 'init', 'ha_activities_register_post_type' );
	

/*
 * Get template from theme, if not in theme get template from plugin
*/	

function humanaquarium_include_template( $template_path ) {
   
	if ( is_page('activities') ) {
	// checks if the file exists in the theme first,
	// otherwise serve the file from the plugin
		if ( $theme_file = locate_template( array ( 'humanaquarium_activities-page.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . 'templates/humanaquarium_activities-page.php';
			}
	}

	else if ( is_singular( 'ha_activities' ) ) {
		if ( $theme_file = locate_template( array ( 'single-humanaquarium_activity.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . 'templates/single-humanaquarium_activity.php';
			}
	}
   
	return $template_path;
}

add_filter( 'template_include', 'humanaquarium_include_template', 1 );


/* 
 * Flush permalinks on plugin activation
*/

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'ha_activities_flush' );
function ha_activities_flush() {
	// call Activities registration function
	ha_activities_register_post_type();
	flush_rewrite_rules();
}