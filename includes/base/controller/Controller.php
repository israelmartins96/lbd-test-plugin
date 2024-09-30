<?php

/**
 * Plugin Controller
 * 
 * @since               0.2.2
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.4
 */
namespace Includes\Base\Controller;

/**
 * Plugin Controller class.
 * 
 * Plugin Controller class.
 * 
 * @since               0.2.2
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Controller {

    /**
     * Prepared to store the plugin's name/unique identifier.
     *
     * @var string
     */
    public $plugin;

    /**
     * Prepared to store current plugin version.
     *
     * @var string
     */
    public $plugin_version;
    
    /**
     * Prepared to store the plugin's base path.
     *
     * @var string
     */
    public $plugin_path;

    /**
     * Prepared to store the plugin's URL.
     *
     * @var string
     */
    public $plugin_url;

    /**
     * Prepared to store the URL suffix of plugin's admin pages.
     *
     * @var string
     */
    public $plugin_admin_suffix;

    /**
     * To store the plugin's admin settings options' names and titles.
     *
     * @var array
     */
    public $settings_sections = array();

    /**
     * To store the ID of the settings section.
     *
     * @var string
     */
    public $settings_section_id = '';
    
    /**
     * Class constructor.
     */
    public function __construct() {
        // Store plugin constants as variables.
        $this->plugin = PLUGIN;

        $this->plugin_version = LBD_VERSION;

        $this->plugin_path = PLUGIN_PATH;
        
        $this->plugin_url = PLUGIN_URL;

        $this->plugin_admin_suffix = PLUGIN_ADMIN_SUFFIX;

        // Array of the plugin's settings sections.
        $this->settings_sections = array(
            'cpt-mgmt'              => 'CPT Manager',
            'taxonomy-mgmt'         => 'Taxonomy Manager',
            'media-widget-mgmt'     => 'Media Widget Manager',
            'gallery-mgmt'          => 'Gallery Manager',
            'testimonial-mgmt'      => 'Testimonial Manager',
            'custom-template-mgmt'  => 'Custom Template Manager',
            'ajax-login-mgmt'       => 'AJAX Login/Register Manager',
            'membership-mgmt'       => 'Membership Manager',
            'chat-mgmt'             => 'Chat Manager'
        );
    }
    
    /**
     * Updates the menu positions of the plugin's admin sub-pages.
     *
     * @return void
     */
    public function set_subpages_positions( $subpages ) {
        // The number of sub-pages.
        $subpages_count = count( $subpages );

        // The starting index for looping through the sub pages.
        $index = 0;

        // The sub-menu position of main sub-page.
        $position = 1;

        // Loop through the array of sub-pages and assign their positions sequentially, starting from the second sub-menu position.
        while ( $index < $subpages_count ) {
            $position++;
            
            $subpages[ $index ]['position'] = $position;
            
            $index++;
        }
    }

    public function is_settings_section_activated( $section_id ) {
        $option = get_option( 'lbd-plugin', 'lbd-plugin' );
        $section = $option[ $section_id ];
        
        $is_section_activated = isset( $section ) ? $section : false;

        return $is_section_activated;
    }

}