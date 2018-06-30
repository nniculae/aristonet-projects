<?php
namespace Aristonet\Taxonomies;
class ProjectCategory{

public function __construct(){
	add_action( 'init', [$this,'project_category_init'] );
	add_filter( 'term_updated_messages', [$this,'project_category_updated_messages' ]);
}

/**
 * Registers the `project_category` taxonomy,
 * for use with 'project'.
 */
function project_category_init() {
	register_taxonomy( 'project-category', array( 'project' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Project categories', 'ap' ),
			'singular_name'              => _x( 'Project category', 'taxonomy general name', 'ap' ),
			'search_items'               => __( 'Search Project categories', 'ap' ),
			'popular_items'              => __( 'Popular Project categories', 'ap' ),
			'all_items'                  => __( 'All Project categories', 'ap' ),
			'parent_item'                => __( 'Parent Project category', 'ap' ),
			'parent_item_colon'          => __( 'Parent Project category:', 'ap' ),
			'edit_item'                  => __( 'Edit Project category', 'ap' ),
			'update_item'                => __( 'Update Project category', 'ap' ),
			'view_item'                  => __( 'View Project category', 'ap' ),
			'add_new_item'               => __( 'New Project category', 'ap' ),
			'new_item_name'              => __( 'New Project category', 'ap' ),
			'separate_items_with_commas' => __( 'Separate project categories with commas', 'ap' ),
			'add_or_remove_items'        => __( 'Add or remove project categories', 'ap' ),
			'choose_from_most_used'      => __( 'Choose from the most used project categories', 'ap' ),
			'not_found'                  => __( 'No project categories found.', 'ap' ),
			'no_terms'                   => __( 'No project categories', 'ap' ),
			'menu_name'                  => __( 'Project categories', 'ap' ),
			'items_list_navigation'      => __( 'Project categories list navigation', 'ap' ),
			'items_list'                 => __( 'Project categories list', 'ap' ),
			'most_used'                  => _x( 'Most Used', 'project-category', 'ap' ),
			'back_to_items'              => __( '&larr; Back to Project categories', 'ap' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'project-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}


/**
 * Sets the post updated messages for the `project_category` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `project_category` taxonomy.
 */
function project_category_updated_messages( $messages ) {

	$messages['project-category'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Project category added.', 'ap' ),
		2 => __( 'Project category deleted.', 'ap' ),
		3 => __( 'Project category updated.', 'ap' ),
		4 => __( 'Project category not added.', 'ap' ),
		5 => __( 'Project category not updated.', 'ap' ),
		6 => __( 'Project categories deleted.', 'ap' ),
	);

	return $messages;
}

}