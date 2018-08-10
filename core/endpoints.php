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
  global $post;
  $query = new WP_Query( array( 
    's' => $request->get_param('search'),
  ) );

  ob_start();
  $to_return = '';
  echo '<div class="grid-contain">';
  foreach( $query->posts as $post ) {
    setup_postdata( $post );
    get_template_part( 'templates/excerpts/excerpt', 'grid' );
  }
  echo '</div>';
  $to_return = ob_get_clean();

  return $to_return;
}