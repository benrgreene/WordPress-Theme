<?php

// Add the notices post type
add_action( 'init', function() {
  register_post_type( 'notices', array(
    'labels' => array(
      'name'          => 'Notices',
      'singular_name' => 'Notice',
    ),
    'public'          => true,
    'has_archive'     => false,
  ) );
} );