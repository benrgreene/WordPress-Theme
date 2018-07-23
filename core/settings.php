<?php

class BRG_Theme_Settings_Admin_Interface_Controller {

    const SETTINGS_PAGE_SLUG  = 'brg_theme_settings_page';
    const SETTINGS_GROUP      = 'brg_theme_group';
    const SETTINGS_NONCE_NAME = 'brg_theme_nonce_name';

    private $plugin_settings = array(
        'brg_settings_account_page_fields',
    );

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu') );
        add_action( 'admin_init', array( $this, 'register_plugin_settings') );
    }

    public function add_admin_menu() {
        $min_level = $this->get_min_level();
        add_menu_page( 'Theme Settings', 'Theme Settings', $min_level, self::SETTINGS_PAGE_SLUG, '', 'dashicons-analytics' );

        // Register submenu for plugin settings - default page for the plugin
        add_submenu_page( self::SETTINGS_PAGE_SLUG, 'Theme Settings', 'Settings', $min_level, self::SETTINGS_PAGE_SLUG, array( $this, 'display_settings_page' ) );
    }

    function get_min_level() {
        return apply_filters( 'brg/theme_options/minimum_user_level', 'edit_posts' );
    }

    public function register_plugin_settings() {
        error_log('message');
        foreach ( $this->plugin_settings as $setting ) {
            register_setting( self::SETTINGS_GROUP, $setting );
        }
    }

    public function display_settings_page() {
        get_template_part( 'templates/admin/settings' );
    }
}
