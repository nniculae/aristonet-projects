<?php 
namespace Aristonet\Shortcodes;

class ShowProjects{

    public function __construct(){
        add_shortcode('aristonet_projects' , function(){
            return apply_filters('aristonet_projects', '<div id="aristonet-projects"></div>');
        });
        
    }
 }