<?php

// Add the notices post type
add_action( 'init', function() {
  register_post_type( 'events', array(
    'labels' => array(
      'name'          => 'Events',
      'singular_name' => 'Event',
    ),
    'public'       => true,
    'has_archive'  => false,
    'supports'     => array(
      'title', 'editor', 'excerpt'
    )
  ) );
} );

add_shortcode( 'display_events', 'brg_display_events' );
function brg_display_events( $atts ) {
  ob_start();
  
  // Form for getting events to display
  get_template_part( 'templates/partials/events-form' );

  // Display the events by form settings
  get_template_part( 'templates/partials/events' );

  return ob_get_clean();
}

// Endpoints for getting the events via AJAX request
add_action( 'rest_api_init', 'brg_events_endpoint' );
function brg_events_endpoint() {
  // Search Endpoint
  register_rest_route( 'brg', '/events/(?P<type>\S+)', array(
    'methods' => 'GET',
    'callback' => 'brg_get_events',
  ) );
}

function brg_get_events( WP_Rest_Request $request ) {
  $event_type = $request->get_param( 'type' );
  $events = get_posts( array(
    'post_type'      => 'events',
    'posts_per_page' => -1,
    'meta_query'     => array(
      array(
        'key'   => 'event_type',
        'value' => $event_type,
      )
    )
  ) );

  $to_return = array();
  foreach( $events as $event ) {
    $event_time = get_field( 'event_date' , $event );
    // check if the event is over before adding it
    if( event_is_past( $event_time, $event_type ) ) { continue; }
    $to_return[] = array(
      'title'     => $event->post_title,
      'excerpt'   => $event->post_excerpt,
      'post_date' => $event_time,
      'post_link' => get_permalink( $event ),
    );
  }

  return json_encode( $to_return );
}

// Given an event, check if the event is a one-time event
// that is over or not
function event_is_past( $event_time, $event_type ) {
  $is_over = false;
  if( 'one-time' == $event_type ) {
    $now = (new DateTime)->format('Ymd');
    $is_over = $now > $event_time;
  }
  return $is_over;
}