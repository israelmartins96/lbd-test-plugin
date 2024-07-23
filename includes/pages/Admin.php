<?php

/**
 * Admin Pages
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\Pages;

use \Includes\Base\Controller;
use \Includes\API\Settings_API;

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
     * To store an instance of the Settings_API
     *
     * @var object
     */
    public $settings;

    /**
     * To store the array of pages.
     *
     * @var array
     */
    public $pages = array();

    /**
     * Gets the plugin menu icon
     *
     * @return string menu icon source
     */
    public function get_menu_icon() {
        $menu_icon_src = file_get_contents( PLUGIN_PATH . 'assets/admin/icons/lbd-icon.svg' );

        $menu_icon = 'data:image/svg+xml;base64,' . base64_encode( $menu_icon_src );

        return $menu_icon;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->settings = new Settings_API();

        $this->pages = array(
            array(
                'page_title'    => 'LBD Plugin',
                'menu_title'    => 'LBD',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-plugin',
                'callback'      => array( $this, 'add_admin_index' ),
                'icon_url'      => '' . $this->get_menu_icon() . '',
                'position'      => 110
            )
        );
    }

    /**
     * Adds admin pages
     * 
     * @since       0.2.0
    */
    public function register() {
        $this->settings->add_pages( $this->pages )->register();
    }

    /**
     * Admin index page
     * 
     * @since       0.2.0
    */
    public function add_admin_index() {
        echo '<h1>LBD Plugin</h1>';
    }
    
}