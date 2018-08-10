<?php

// Display any current notices
add_action( 'before_site_content', 'brg_display_notices' );
function brg_display_notices() {
  global $post;

  $notices = get_posts( array(
    'post_type'      => 'notices',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
  ) );

  foreach ( $notices as $post ) {
    setup_postdata( $post );
    get_template_part( 'templates/excerpts/excerpt', 'notices' );
  }
  wp_reset_postdata();
}

// Need to check if the current view is restriced to members only.
// If so & they aren't logged in, redirect the user to the homepage
add_action( 'wp', 'brg_check_members_only' );
function brg_check_members_only() {
  global $current_user; 
  $current_user = wp_get_current_user();
  $level = get_field( 'minimum_level' );

  if( 'any' == $level ||
      false == $level ) {
    return;
  }
  
  if( ! user_can( $current_user, $level ) ) {
    $home_url = get_home_url();
    wp_redirect( $home_url );
    exit;
  }
}

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
  return array( 'post', 'notices', 'events' );
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