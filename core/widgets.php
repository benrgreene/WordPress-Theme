<?php

add_action( 'widgets_init', 'brg_add_widgets' );
function brg_add_widgets() {

  // Footer Sidebar
  register_sidebar( array(
    'name'          => 'Footer Widgets',
    'id'            => 'brg_footer_widgets',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="footer-widgets__title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => 'Sidebar Widgets',
    'id'            => 'brg_sidebar',
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="sidebar-widget__title">',
    'after_title'   => '</h3>',
  ) );
}

add_action( 'after_setup_theme', 'brg_setup_menus' );
function brg_setup_menus() {
  register_nav_menu( 'primary_menu', 'Primary Header Menu' );  
}
