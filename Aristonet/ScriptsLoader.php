<?php 
namespace Aristonet;

class ScriptsLoader{
    public function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
        //add_filter( 'script_loader_tag', 'addModuleToScript', 10, 3 );   
    }
    public function loadScripts(){

        wp_enqueue_style('nanobar-css', Aristonet_Projects_Plugin_Dir_Url . 'assets/css/nanobar.css');
        wp_enqueue_style('aristonet-projects-css', Aristonet_Projects_Plugin_Dir_Url . 'assets/css/projects.css');

        wp_enqueue_script('nanobar-js',Aristonet_Projects_Plugin_Dir_Url . 'assets/node_modules/nanobar/nanobar.js', [ ], null, true );
        wp_enqueue_script( 'mustache', Aristonet_Projects_Plugin_Dir_Url . 'assets/node_modules/mustache/mustache.js', [], null, true );
        wp_enqueue_script( 'aristonet-projects-js', Aristonet_Projects_Plugin_Dir_Url . 'assets/js/projects.js', ['nanobar-js','mustache'], null, true );
        

        wp_localize_script(
            'aristonet-projects-js',
            'aristonet_projects_php_vars',
            [
             
              'nonce'     => wp_create_nonce( 'wp_rest' ),
              'rest_url'  => esc_url_raw( rest_url() ),
              'templatesUrl' => Aristonet_Projects_Plugin_Dir_Url . 'assets/templates',
              'templateName' => get_option('aristonet_projects_template_name', 'ProjectList.mst'),
              'singleProjectTemplateName' =>get_option('aristonet_project_template_name', 'SingleProject.mst'),
              'shortcode_location' => get_option('aristonet_projects_shortcode_post_slug', 'project' ),
              'projects_per_page' => get_option('aristonet_projects_per_page', 10 )
            ]
        );

    }
   
 //aristonet_projects_per_page
    // public function addModuleToScript( $tag, $handle, $src ) {

    //     if ( 'main-component' === $handle ) {
    //         $tag = '<script type="module" src="'.esc_url( $src ).'"></script>';
    //     }
    //      return $tag;
    // }

}