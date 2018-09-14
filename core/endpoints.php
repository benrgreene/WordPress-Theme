<?php

add_action( 'rest_api_init', 'brg_add_rest_endpoints' );
function brg_add_rest_endpoints() {
  // Search Endpoint
  register_rest_route( 'brg', '/search/(?P<search>\S+)', array(
    'methods' => 'GET',
    'callback' => 'brg_get_search_results',
  ) );
}

// Return basic info of each post
function brg_get_search_results( WP_REST_Request $request ) {
  $loader = new BG_Post_Archive_Delegator(
    'search', 0, $request['search']
  );
  
  ob_start();
  echo '<div class="grid-contain">';
  $loader->get_next_posts();
  echo '</div>';
  return ob_get_clean();
}

// Add an endpoint for loading the posts
add_action( 'rest_api_init', 'brg_get_next_posts_callback' );
function brg_get_next_posts_callback() {
  register_rest_route( 'post', 'get-posts/(?P<on>[0-9-]+)', array(
    'methods' => 'GET',
    'callback'  => 'brg_load_next_posts',
  ) );

  // This is the category callback
  register_rest_route( 'post', 'get-posts/(?P<category_id>[0-9]+)/(?P<on>[0-9-]+)', array(
    'methods' => 'GET',
    'callback'  => 'brg_load_next_posts',
  ) );
}

// Callback for REST endpoint to load the next page of results
function brg_load_next_posts( $data ) {
  $category_id = isset( $data['category_id'] ) ? $data['category_id'] : false;
  $loader = new BG_Post_Archive_Delegator(
    'post', $data['on'], false, $category_id
  );
  
  ob_start();
  $loader->get_next_posts();
  return ob_get_clean();
}