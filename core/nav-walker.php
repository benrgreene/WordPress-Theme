<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

class BRG_Menu_Walker extends Walker_Nav_Menu {

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "<ul class=\"sub-menu\">\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  /**
   * Custom walker. Add the widgets into the menu.
   *
   * @see Walker::start_el()
   *
   * @since 1.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item   Menu item data object.
   * @param int    $depth  Depth of menu item. Used for padding.
   * @param array  $args   An array of arguments. @see wp_nav_menu()
   * @param int    $id     Current item ID.
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    // Item ID
    $id = "menu-item-" . $item->ID;

    // Item Class
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    if ( is_array( $item->classes ) && ! in_array( "menu-column", $item->classes ) && ! in_array( "menu-row", $item->classes ) ) {
      $classes[] = 'menu-item-' . $item->ID;
    }

    $class = implode(' ', $classes);
    $output .= "<li class='{$class}' id='{$id}'>";

    // output the widgets
    if ( $item->type == 'widget' && $item->content ) {
      $item_output = $item->content;
    } else {
      $atts = array();
      $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
      $atts['target'] = ! empty( $item->target ) ? $item->target : '';
      $atts['class'] = '';
      $atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';

      // required for Surface/Win10/Edge
      if ( in_array('menu-item-has-children', $classes ) ) {
        $atts['aria-haspopup'] = "true";
      }

      if ( $depth == 0 ) {
        $atts['tabindex'] = "0";
      }

      $title = $item->title;
      // For text items (non icon items) white space should be non breakiing - due to styling (want to let menus flow as long as they need to),
      if( false === strpos( $title, '<i' ) ) {
        $title = str_replace(' ', '&nbsp;', $item->title);
      }

      $item_output = $args->before;
      $item_output .= '<a href="' . $item->url . '">';
      $item_output .= $title;
      $item_output .= '</a>';
      $item_output .= $args->after;

      if ( is_array( $item->classes ) && in_array( "menu-column", $item->classes ) || in_array( "menu-row", $item->classes ) ) {
        $item_output = "";
      }
    }

    $output .= $item_output;
  }

  public function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>";
  }
}