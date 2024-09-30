<?php

/**
 * Settings API
 * 
 * @since               0.2.3
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.2
 */
namespace Includes\API;

/**
 * Settings API class.
 * 
 * Settings API class.
 * 
 * @since               0.2.3
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Settings_API {
    
    /**
     * Plugin admin pages.
     *
     * @var array
     */
    public $admin_pages = array();
    
    /**
     * Plugin admin sub-pages.
     *
     * @var array
     */
    public $admin_subpages = array();

    /**
     * Plugin admin settings
     *
     * @var array
     */
    public $settings = array();

    /**
     * Plugin admin settings sections
     *
     * @var array
     */
    public $settings_sections = array();

    /**
     * Plugin admin settings fields
     *
     * @var array
     */
    public $settings_fields = array();

    /**
     * Adds the admin menu
     *
     * @return void
     */
    public function register() {
        if ( ! empty( $this->admin_pages ) || ! empty( $this->admin_subpages ) ) {
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        }

        if ( ! empty( $this->settings ) ) {
            add_action( 'admin_init', array( $this, 'register_custom_fields' ) );
        }
    }
    
    /**
     * Updates the array of admin pages.
     *
     * @param array $pages
     * @return void
     */
    public function add_pages( array $pages ) {
        $this->admin_pages = $pages;

        return $this;
    }

    /**
     * Adds the main sub-page of the plugin admin dashboard
     *
     * @param string $title
     * @return void
     */
    public function with_subpage( string $title = null ) {
        if ( empty( $this->admin_pages ) ) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug'   => $admin_page['menu_slug'],
                'page_title'    => $admin_page['page_title'],
                'menu_title'    => $title ? $title : $admin_page['menu_title'],
                'capability'    => $admin_page['capability'],
                'menu_slug'     => $admin_page['menu_slug'],
                'callback'      => $admin_page['callback'],
                'position'      => 1
            )
        );

        $this->admin_subpages = $subpage;

        return $this;
    }

    /**
     * Updates the array of admin sub-pages.
     *
     * @param array $pages
     * @return void
     */
    public function add_subpages( array $pages ) {
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages );

        return $this;
    }

    /**
     * Prepares the admin menu pages.
     *
     * @return void
     */
    public function add_admin_menu() {
        // Admin menu page
        foreach ( $this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
        }

        // Main sub-page
        foreach ( $this->admin_subpages as $subpage ) {
            add_submenu_page( $subpage['parent_slug'], $subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['callback'], $subpage['position'] );
        }
    }

    /**
     * Updates the plugin settings.
     *
     * @param array $settings
     * @return void
     */
    public function set_settings( array $settings ) {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Updates the settings sections.
     *
     * @param array $settings_sections
     * @return void
     */
    public function set_settings_sections( array $settings_sections ) {
        $this->settings_sections = $settings_sections;

        return $this;
    }

    /**
     * Updates the settings fields.
     *
     * @param array $settings_fields
     * @return void
     */
    public function set_settings_fields( array $settings_fields ) {
        $this->settings_fields = $settings_fields;
        
        return $this;
    }

    /**
     * Prepares the admin custom fields.
     *
     * @return void
     */
    public function register_custom_fields() {
        // Register setting
        foreach ( $this->settings as $setting ) {
            register_setting( $setting['option_group'], $setting['option_name'], ( isset( $setting['callback'] ) ? $setting['callback'] : '' ) );
        }

        // Add settings section
        foreach ( $this->settings_sections as $settings_section ) {
            add_settings_section( $settings_section['id'], $settings_section['title'], ( isset( $settings_section['callback'] ) ? $settings_section['callback'] : '' ), $settings_section['page'] );
        }

        // Add settings field
        foreach ( $this->settings_fields as $settings_field ) {
            add_settings_field( $settings_field['id'], $settings_field['title'], ( isset( $settings_field['callback'] ) ? $settings_field['callback'] : '' ), $settings_field['page'], $settings_field['section'], ( isset( $settings_field['args'] ) ? $settings_field['args'] : array() ) );
        }
    }
    
}