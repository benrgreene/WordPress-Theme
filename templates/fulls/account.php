<section class="account-page">
  
  <?php 
    $display_fields = apply_filters( 'brg/displayed_member_fields', array() );
    foreach( $display_fields as $field ):
      echo sprintf('<h2 class="user-dates-section">%s</h2>', str_replace("_", " ", $field) );
      the_services_dates( $field );
    endforeach;
  ?>
  
</section>