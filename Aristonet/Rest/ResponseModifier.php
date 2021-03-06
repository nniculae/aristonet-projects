<?php 
namespace Aristonet\Rest;

class ResponseModifier{

    public function __construct(){
        add_filter('rest_prepare_project', [$this,'addPropertiesToResponse'],10, 3);
    }
   

    public function addPropertiesToResponse(\WP_REST_Response $response, \WP_Post $post, \WP_REST_Request $request ){
        $id =  $post->ID;  
        
        // custom fields
        $response->data['description'] = get_post_meta($id,'description', true);
        $response->data['release_date'] = get_post_meta($id,'release_date', true);
        $response->data['excerpt_list'] = get_post_meta($id,'excerpt_list', true);
        $response->data['excerpt_single'] = get_post_meta($id,'excerpt_single', true);
        $response->data['website_link'] = get_post_meta($id,'website_link', true);
        $response->data['client_reference'] = get_post_meta($id,'client_reference', true);
        
        
        // featured image
        $response->data['featuredImageSrc'] = get_the_post_thumbnail_url( $id, 'full' ) ?? null;

        // taxonomies
        $response->data['project_categories'] = wp_get_post_terms($id,'project-category');
        $response->data['project_tags'] = wp_get_post_terms($id,'project-tag');


        $response->data['nextProject'] = get_next_post();
       

        
        return $response;
       
    }
}