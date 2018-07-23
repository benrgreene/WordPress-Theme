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

//add_action( 'wp', 'brg_check_members_only' );
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

add_filter('widget_text', 'do_shortcode');

add_filter('brg/body_class', 'brg_add_body_classes');
function brg_add_body_classes( $classes ) {
  if( is_user_logged_in() ) {
    $classes .= 'is-logged-in';
  }

  return $classes;
}
