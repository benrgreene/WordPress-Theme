<?php

function the_media_background( $post_id ) {
  echo get_media_background( $post_id );
}

function get_media_background( $post_id ) {
  if( has_post_thumbnail( $post_id ) ):
    return get_the_post_thumbnail_url( $post_id );
  endif;
  return false;
}

/**
 * Display service dates (stored in ACF textarea) by given parameter
 */
function the_services_dates( $field_data ) {
  $raw_dates = get_field( $field_data, wp_get_current_user() );
  if( ! $raw_dates ) {
    return;
  }

  $dates = explode( "\n", $raw_dates );
  echo '<ul class="service-dates">';
  foreach ( $dates as $date ) {
    $date_obj = new DateTime( $date );
    echo '<li class="service-date">' . $date_obj->format( 'F jS, Y' ) . '</li>';
  }
  echo '</ul>';
}