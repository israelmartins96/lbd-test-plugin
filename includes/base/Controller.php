<?php

/**
 * Plugin Controller
 * 
 * @since               0.2.2
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.3
 */
namespace Includes\Base;

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
    public $settings_options = array();

    /**
     * Class constructor. Store plugin constants as variables.
     */
    public function __construct() {
        $this->plugin = PLUGIN;

        $this->plugin_version = LBD_VERSION;

        $this->plugin_path = PLUGIN_PATH;
        
        $this->plugin_url = PLUGIN_URL;

        $this->plugin_admin_suffix = PLUGIN_ADMIN_SUFFIX;

        $this->settings_options = array(
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
    
}