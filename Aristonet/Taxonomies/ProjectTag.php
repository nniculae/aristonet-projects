<?php
namespace Aristonet\Taxonomies;

class ProjectTag{
	public function __construct(){
		add_action( 'init', [$this,'project_tag_init' ]);
		add_filter( 'term_updated_messages', [$this,'project_tag_updated_messages'] );
	}
/**
 * Registers the `project_tag` taxonomy,
 * for use with 'project'.
 */
function project_tag_init() {
	register_taxonomy( 'project-tag', array( 'project' ), array(
		'hierarchical'      => false,
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
			'name'                       => __( 'Project tags', 'ap' ),
			'singular_name'              => _x( 'Project tag', 'taxonomy general name', 'ap' ),
			'search_items'               => __( 'Search Project tags', 'ap' ),
			'popular_items'              => __( 'Popular Project tags', 'ap' ),
			'all_items'                  => __( 'All Project tags', 'ap' ),
			'parent_item'                => __( 'Parent Project tag', 'ap' ),
			'parent_item_colon'          => __( 'Parent Project tag:', 'ap' ),
			'edit_item'                  => __( 'Edit Project tag', 'ap' ),
			'update_item'                => __( 'Update Project tag', 'ap' ),
			'view_item'                  => __( 'View Project tag', 'ap' ),
			'add_new_item'               => __( 'New Project tag', 'ap' ),
			'new_item_name'              => __( 'New Project tag', 'ap' ),
			'separate_items_with_commas' => __( 'Separate project tags with commas', 'ap' ),
			'add_or_remove_items'        => __( 'Add or remove project tags', 'ap' ),
			'choose_from_most_used'      => __( 'Choose from the most used project tags', 'ap' ),
			'not_found'                  => __( 'No project tags found.', 'ap' ),
			'no_terms'                   => __( 'No project tags', 'ap' ),
			'menu_name'                  => __( 'Project tags', 'ap' ),
			'items_list_navigation'      => __( 'Project tags list navigation', 'ap' ),
			'items_list'                 => __( 'Project tags list', 'ap' ),
			'most_used'                  => _x( 'Most Used', 'project-tag', 'ap' ),
			'back_to_items'              => __( '&larr; Back to Project tags', 'ap' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'project-tag',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}

/**
 * Sets the post updated messages for the `project_tag` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `project_tag` taxonomy.
 */
function project_tag_updated_messages( $messages ) {

	$messages['project-tag'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Project tag added.', 'ap' ),
		2 => __( 'Project tag deleted.', 'ap' ),
		3 => __( 'Project tag updated.', 'ap' ),
		4 => __( 'Project tag not added.', 'ap' ),
		5 => __( 'Project tag not updated.', 'ap' ),
		6 => __( 'Project tags deleted.', 'ap' ),
	);

	return $messages;
}

}