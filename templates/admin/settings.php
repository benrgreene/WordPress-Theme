<div class="wrap">
  <h1>Theme Settings</h1>
  <hr/>

  <form method="POST" action="options.php" novalidate="novalidate">
    <?php settings_fields( 'brg_theme_group' ); ?>
    
    <h2>User Fields</h2>
    <h3>What fields should be displayed on user account pages?</h3>
    <p>(Enter each field slug on a new line)</p>
    <textarea id="brg_settings_account_page_fields" name="brg_settings_account_page_fields" cols="70" rows="10"><?php echo get_option('brg_settings_account_page_fields'); ?></textarea>
    
    <?php submit_button(); ?>
  </form>
</div>