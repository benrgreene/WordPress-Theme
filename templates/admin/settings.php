<div class="wrap">
  <h1>Theme Settings</h1>
  <hr/>

  <form method="POST" action="options.php" novalidate="novalidate">
    <?php settings_fields( 'brg_theme_group' ); ?>
    
    <h2>Theme Colors</h2>
    <table>
      <tr>
        <td>Primary Theme Color</td>
        <td><input name="primary_theme_color" id="primary_theme_color" value="<?php echo get_option('primary_theme_color'); ?>" /></td>
        <td>This will be the main color used as the background color.</td>
      </tr>
      <tr>
        <td>Accent Theme Color</td>
        <td><input name="accent_theme_color" id="accent_theme_color" value="<?php echo get_option('accent_theme_color'); ?>" /></td>
        <td>The accent color will be used as the link color.</td>
      </tr>
    </table>

    <h2>Archives</h2>
    <?php $post_types = apply_filters( 'brg/archived_post_types', array() ); ?>
    <table>
      <?php foreach( $post_types as $post_type ): ?>
        <?php $selected = get_option('brg_settings_display_' . $post_type); ?>
        <tr>
          <td>Display `<?php echo $post_type; ?>` post type as:</td>
          <td><select name="brg_settings_display_<?php echo $post_type; ?>">
            <option value="grid">Grid</option>
            <option value="stacked"<?php if('stacked' == $selected): echo ' selected="selected"'; endif; ?>>Stacked</option>
          </select></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <?php submit_button(); ?>
  </form>
</div>