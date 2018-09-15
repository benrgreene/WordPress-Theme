<?php

// Want to make sure widgets will allow shortcodes
add_filter('widget_text', 'do_shortcode');

// Need to add if the current user is logged into the site
add_filter('brg/body_class', 'brg_add_body_classes');
function brg_add_body_classes( $classes ) {
  if( is_user_logged_in() ) {
    $classes .= 'is-logged-in';
  }

  return $classes;
}

// These are the post types that will have options for how to display
// their archives. 
add_filter( 'brg/archived_post_types', 'brg_add_archived_post_types' );
function brg_add_archived_post_types( $post_types ) {
  return array( 'post', 'search' );
}

// Add titles to the archive pages
add_action( 'before_site_content', 'brg_display_archive_title' );
function brg_display_archive_title() {
  if( is_archive() ) {
    echo '<div class="l-contain">';
    echo sprintf( '<h1 class="page_title">%s</h1>', get_the_archive_title() );
    echo '</div>';
  }
}