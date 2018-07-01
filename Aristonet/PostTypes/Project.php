<?php
namespace Aristonet\PostTypes;

class Project{

	
	public function __construct(){
		add_action( 'init', [$this,'project_init']);
		add_filter( 'post_updated_messages', [$this, 'project_updated_messages' ]);
	}
/**
 * Registers the `project` post type.
 */
function project_init() {
	register_post_type( 'project', array(
		'labels'                => array(
			'name'                  => __( 'Projects', 'ap' ),
			'singular_name'         => __( 'Project', 'ap' ),
			'all_items'             => __( 'All Projects', 'ap' ),
			'archives'              => __( 'Project Archives', 'ap' ),
			'attributes'            => __( 'Project Attributes', 'ap' ),
			'insert_into_item'      => __( 'Insert into project', 'ap' ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', 'ap' ),
			'featured_image'        => _x( 'Project Image', 'project', 'ap' ),
			'set_featured_image'    => _x( 'Set project image', 'project', 'ap' ),
			'remove_featured_image' => _x( 'Remove project image', 'project', 'ap' ),
			'use_featured_image'    => _x( 'Use as project image', 'project', 'ap' ),
			'filter_items_list'     => __( 'Filter projects list', 'ap' ),
			'items_list_navigation' => __( 'Projects list navigation', 'ap' ),
			'items_list'            => __( 'Projects list', 'ap' ),
			'new_item'              => __( 'New Project', 'ap' ),
			'add_new'               => __( 'Add New', 'ap' ),
			'add_new_item'          => __( 'Add New Project', 'ap' ),
			'edit_item'             => __( 'Edit Project', 'ap' ),
			'view_item'             => __( 'View Project', 'ap' ),
			'view_items'            => __( 'View Projects', 'ap' ),
			'search_items'          => __( 'Search projects', 'ap' ),
			'not_found'             => __( 'No projects found', 'ap' ),
			'not_found_in_trash'    => __( 'No projects found in trash', 'ap' ),
			'parent_item_colon'     => __( 'Parent Project:', 'ap' ),
			'menu_name'             => __( 'Projects', 'ap' ),
		),
		// 'taxonomies'			=> ['project_categories','project_tags'],
		'public'                => true,
		'hierarchical'          => true,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'thumbnail','page-attributes'),
		'has_archive'           => false,
		'publicly_queryable'    => true,
		'exclude_from_search'   => false,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'project',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'capability_type' => 'post',
	) );

}



/**
 * Sets the post updated messages for the `project` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `project` post type.
 */
function project_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['project'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Project updated. <a target="_blank" href="%s">View project</a>', 'ap' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'ap' ),
		3  => __( 'Custom field deleted.', 'ap' ),
		4  => __( 'Project updated.', 'ap' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'ap' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Project published. <a href="%s">View project</a>', 'ap' ), esc_url( $permalink ) ),
		7  => __( 'Project saved.', 'ap' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview project</a>', 'ap' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'ap' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'ap' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

}