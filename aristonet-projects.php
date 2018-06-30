<?php
/*
Plugin Name: Projects
Plugin URI: https://www.aristonet.nl
Description: Add and display projects
Version: 1.0
Author: Niculae Niculae
Author URI: http://www.niculae.aristonet.nl
Copyright: Niculae Niculae
Text Domain: ap
Domain Path: /languages
*/
// Your code starts here.
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
define('Aristonet_Projects_Plugin_Dir_Url',  plugin_dir_url(__FILE__) );

register_activation_hook( __FILE__, function(){
        update_option('aristonet_projects_template_name', 'ProjectList.mst');
        update_option('aristonet_project_template_name', 'SingleProject.mst');
 });

 add_action('init', function(){
        add_rewrite_rule('project/([^/]*)/?', 'index.php?pagename=proiecte','top');
 },999,0);

abstract class AristonetProjects{
	public static function Main(){
        new Aristonet\PostTypes\Project();
        new Aristonet\Metaboxes\ProjectPropertiesMetabox();
        new Aristonet\Taxonomies\ProjectCategory();
        new Aristonet\Taxonomies\ProjectTag();
        new Aristonet\Rest\ResponseModifier();
        new Aristonet\Shortcodes\ShowProjects();
        new Aristonet\ScriptsLoader();
        new Aristonet\Settings\Settings();
	}
}
AristonetProjects::Main();
