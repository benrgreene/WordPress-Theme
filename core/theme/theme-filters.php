<?php 

/**
 * These filters are for a per-theme basis
 */

add_filter( 'brg/displayed_member_fields', function( $fields ) {
  $fields[] = 'service_team_dates';
  $fields[] = 'snack_team_dates';
  return $fields;
});
