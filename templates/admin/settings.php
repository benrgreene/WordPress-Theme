<div class="wrap">
  <h1>Theme Settings</h1>
  <hr/>

  <form method="POST" action="options.php" novalidate="novalidate">
    <?php settings_fields( 'brg_theme_group' ); ?>
    
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