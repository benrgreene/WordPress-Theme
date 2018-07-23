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
  $query = new WP_Query( array( 
    's' => $request->get_param('search'),
  ) );

  $to_return = array();
  foreach( $query->posts as $a_post ) {
    $to_return[] = array(
      'title'     => $a_post->post_title,
      'excerpt'   => $a_post->post_excerpt,
      'post_date' => $a_post->post_date,
      'post_link' => get_permalink( $a_post ),
    );
  }

  return json_encode( $to_return );
}