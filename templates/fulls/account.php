<section class="account-page">
  
  <?php 
    $raw_display_fields = get_option( 'brg_settings_account_page_fields' ); 
    $display_fields = preg_split( "/[\s]+/", $raw_display_fields );
    foreach( $display_fields as $field ):
      echo sprintf('<h2 class="user-dates-section">%s</h2>', str_replace("_", " ", $field) );
      the_services_dates( $field );
    endforeach;
  ?>
  
</section>