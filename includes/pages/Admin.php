<?php

/**
 * Admin Pages
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.4
 */
namespace Includes\Pages;

use \Includes\Base\Controller;
use \Includes\API\Settings_API;
use \Includes\API\Callbacks\Admin_Callbacks;
use \Includes\API\Callbacks\Management_Callbacks;

/**
 * Admin Pages class.
 * 
 * Admin pages class.
 * 
 * @since               0.2.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Admin extends Controller {

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
     * To store the array of sub-pages of the plugin admin dashboard.
     *
     * @var array
     */
    public $subpages = array();

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

        // Popuplate the plugin's admin sub-pages array.
        $this->set_subpages();
        
        $this->set_settings();

        $this->set_settings_sections();

        $this->set_settings_fields();
        
        // Adds the plugin admin pages and sub-pages
        $this->settings_API->add_pages( $this->pages )->with_subpage( 'Dashboard' )->add_subpages( $this->subpages )->register();
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
     * Updates the menu positions of the plugin's admin sub-pages.
     *
     * @return void
     */
    public function set_subpages_positions() {
        // The number of sub-pages.
        $subpages_count = count( $this->subpages );

        // The starting index for looping through the sub pages.
        $index = 0;

        // The sub-menu position of main sub-page.
        $position = 1;

        // Loop through the array of sub-pages and assign their positions sequentially, starting from the second sub-menu position.
        while ( $index < $subpages_count ) {
            $position++;
            
            $this->subpages[ $index ]['position'] = $position;
            
            $index++;
        }
    }

    /**
     * Popuplates the plugin's admin sub-pages array.
     *
     * @return void
     */
    public function set_subpages() {
        $this->subpages = array(
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Post Types',
                'menu_title'    => 'Custom Post Types',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-custom-post-types',
                'callback'      => array( $this->callbacks, 'custom_post_types_dashboard' ),
                'position'      => 0
            ),
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Taxonomies',
                'menu_title'    => 'Taxonomies',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-taxonomies',
                'callback'      => array( $this->callbacks, 'taxonomies_dashboard' ),
                'position'      => 0
            ),
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Widgets',
                'menu_title'    => 'Widgets',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-widgets',
                'callback'      => array( $this->callbacks, 'widgets_dashboard' ),
                'position'      => 0
            )
        );

        // Sequentially update the menu positions of the plugin's admin sub-pages.
        $this->set_subpages_positions();
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
                'option_name'   => 'cpt-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'taxonomy-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'media-widget-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'gallery-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'testimonial-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'custom-template-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'ajax-login-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'membership-mgmt',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_checkbox_sanitise' )
            ),
            array(
                'option_group'  => 'lbd_plugin_settings',
                'option_name'   => 'chat-mgmt',
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
        $args = array(
            array(
                'id'            => 'cpt-mgmt',
                'title'         => 'CPT Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'cpt-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'taxonomy-mgmt',
                'title'         => 'Taxonomy Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'taxonomy-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'media-widget-mgmt',
                'title'         => 'Media Widget Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'media-widget-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'gallery-mgmt',
                'title'         => 'Gallery Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'gallery-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'testimonial-mgmt',
                'title'         => 'Testimonial Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'testimonial-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'custom-template-mgmt',
                'title'         => 'Custom Template Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'custom-template-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'ajax-login-mgmt',
                'title'         => 'AJAX Login/Register Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'ajax-login-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'membership-mgmt',
                'title'         => 'Membership Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'membership-mgmt',
                    'class'         => 'ui-toggle'
                )
            ),
            array(
                'id'            => 'chat-mgmt',
                'title'         => 'CPT Manager',
                'callback'      => array( $this->callbacks_mgmt, 'lbd_settings_checkbox' ),
                'page'          => 'lbd-plugin',
                'section'       => 'lbd-admin-index',
                'args'          => array(
                    'label_for'     => 'chat-mgmt',
                    'class'         => 'ui-toggle'
                )
            )
        );

        $this->settings_API->set_settings_fields( $args );
    }
    
}