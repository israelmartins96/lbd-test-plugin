<?php

/**
 * Admin Pages
 * 
 * @since               0.3.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\Pages;

use \Includes\Base\Controller\Controller;
use \Includes\API\Settings_API;
use \Includes\API\Callbacks\Admin_Callbacks;
use \Includes\API\Callbacks\Management_Callbacks;

/**
 * Admin Pages class.
 * 
 * Admin pages class.
 * 
 * @since               0.3.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Dashboard extends Controller {

    /**
     * To store an instance of the Settings_API.
     *
     * @var object
     */
    public $settings_API;

    /**
     * To store an instance of the Admin_Callbacks.
     *
     * @var object
     */
    public $callbacks;

    /**
     * To store an instance of the Management_Callbacks.
     *
     * @var object
     */
    public $callbacks_mgmt;

    /**
     * To store the array of pages.
     *
     * @var array
     */
    public $pages = array();

    /**
     * Gets the plugin menu icon.
     *
     * @return string $menu_icon menu icon source
     */
    public function get_menu_icon() {
        $menu_icon_src = file_get_contents( $this->plugin_path . 'assets/admin/icons/lbd-icon.svg' );

        $menu_icon = 'data:image/svg+xml;base64,' . base64_encode( $menu_icon_src );

        return $menu_icon;
    }

    /**
     * Adds admin pages.
     * 
     * @since       0.2.0
    */
    public function register() {
        // Instance of the plugin's Settings_API class.
        $this->settings_API = new Settings_API();

        // Instance of the plugin's Admin_Callbacks class.
        $this->callbacks = new Admin_Callbacks();

        // Instance of the plugin's Management_Callbacks class.
        $this->callbacks_mgmt = new Management_Callbacks();

        // Popuplate the plugin's main admin page array.
        $this->set_pages();
        
        $this->set_settings();

        $this->set_settings_sections();

        $this->set_settings_fields();
        
        // Adds the plugin admin pages and sub-pages
        $this->settings_API->add_pages( $this->pages )->with_subpage( 'Dashboard' )->register();
    }

    /**
     * Popuplates the plugin's main admin page array.
     *
     * @return void
     */
    public function set_pages() {
        $this->pages = array(
            array(
                'page_title'    => 'LBD Plugin',
                'menu_title'    => 'LBD',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-plugin',
                'callback'      => array( $this->callbacks, 'lbd_dashboard' ),
                'icon_url'      => '' . $this->get_menu_icon() . '',
                'position'      => 110
            )
        );
    }

    /**
     * Adds custom fields options.
     *
     * @return void
     */
    public function set_settings() {
        $args = array(
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'lbd-plugin',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            )
        );
        
        $this->settings_API->set_settings( $args );
    }

    /**
     * Adds custom fields sections.
     *
     * @return void
     */
    public function set_settings_sections() {
        $args = array(
            array(
                'id'            => 'lbd-admin-index',
                'title'         => 'Settings',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_admin_manager' ),
                'page'          => 'lbd-plugin'
            )
        );

        $this->settings_API->set_settings_sections( $args );
    }

    /**
     * Adds custom fields.
     *
     * @return void
     */
    public function set_settings_fields() {
        $checkbox_class = 'lbd-feature';
        
        $args = array();

        foreach ( $this->settings_sections as $section_id => $title ) {
            $args[] = array(
                'id'            => $section_id,
                'title'         => $title,
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'option_name'   => 'lbd-plugin',
                    'label_for'     => $section_id,
                    'class'         => $checkbox_class
                )
            );
        }

        $this->settings_API->set_settings_fields( $args );
    }
    
}