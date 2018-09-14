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

function brg_the_categories() {
  $categories = wp_get_post_categories( get_the_ID() );
  if( !is_wp_error( $categories ) && 0 < count( $categories ) ) {
    echo '<span>Categories:</span>';
    echo '<ul class="post__categories">';
    foreach( $categories as $category ) {
      $term = get_term( $category, 'category' );
      $term_link = get_term_link( $category );
      echo sprintf( '<li><a href="%s">%s</a></li>', $term_link, $term->name );
    }
    echo '</ul>';
  }
}