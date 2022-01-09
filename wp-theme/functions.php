<?php
// enable featured images 
add_theme_support( 'post-thumbnails' );

// expose custom field 'youtube' to REST api
add_action( 'rest_api_init', 'create_api_posts_meta_field' );

function create_api_posts_meta_field() {

    // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
    register_rest_field( 'page', 'customfields', array(
           'get_callback'    => 'get_post_meta_for_api',
           'schema'          => null,
        )
    );
}

function get_post_meta_for_api( $object ) {
    //get the id of the post object array
    $post_id = $object['id'];

    //return the post meta
    return get_post_meta( $post_id );
}

// allow comments through REST api

add_filter( 'rest_allow_anonymous_comments', '__return_true' );


/**
 * Returns menu items in a array based on the navigation menu id passed
 */
function expose_navigation($request) {
    $id = $request['id'];
    return wp_get_nav_menu_items($id);
  }
  
  /**
   * Exposes under /navigation/{id} the menu items in the wp-json api
   *
   * @return void
   */
  function expose_navigation_to_rest() {
    register_rest_route( 'wp/v2', '/navigation/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'expose_navigation'
      ]
    );
  }
  
  add_action('rest_api_init', 'expose_navigation_to_rest');

// increase the limit for fetching comments through REST api
  $post_type = 'comment';
  add_filter("rest_{$post_type}_collection_params", function($params) {
      $params['per_page']['maximum'] = 500;
      return $params;
  });

?>