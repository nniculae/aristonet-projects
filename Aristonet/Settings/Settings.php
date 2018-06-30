<?php 
namespace Aristonet\Settings;

class Settings {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
        
        


	}
	public function wph_create_settings() {
		$page_title = 'Projects Settings';
		$menu_title = 'Projects Settings';
		$capability = 'manage_options';
		$slug = 'projectssettings';
		$callback = array($this, 'wph_settings_content');
        //add_media_page($page_title, $menu_title, $capability, $slug, $callback);
        add_submenu_page('edit.php?post_type=project',$page_title, $menu_title, $capability, $slug, $callback);
	}
	public function wph_settings_content() { ?>
		<div class="wrap">
			<h1>Projects Settings</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'projectssettings' );
					do_settings_sections( 'projectssettings' );
					submit_button();
				?>
			</form>
		</div> <?php
	}
	public function wph_setup_sections() {
		add_settings_section( 'projectssettings_section', '', array(), 'projectssettings' );
	}
	public function wph_setup_fields() {
		$fields = array(
			array(
				'label' => 'List Of Projects Template',
				'id' => 'aristonet_projects_template_name',
				'type' => 'text',
				'section' => 'projectssettings_section',
			),
			array(
				'label' => 'Single Project Template',
				'id' => 'aristonet_project_template_name',
				'type' => 'text',
				'section' => 'projectssettings_section',
			),
			array(
				'label' => 'Shortcode Post Slug',
				'id' => 'aristonet_projects_shortcode_post_slug',
				'type' => 'text',
				'section' => 'projectssettings_section',
			),
			
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'projectssettings', $field['section'], $field );
			register_setting( 'projectssettings', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value =  get_option( $field['id'] ); // ?  get_option( $field['id'] ) : 'default-template.js'; 
		switch ( $field['type'] ) {
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$field['placeholder'] ?? '',
					$value
				);
		}
		if( $desc = $field['desc'] ?? '' ) {
			printf( '<p class="description">%s </p>', $desc );
		}
	}
}
