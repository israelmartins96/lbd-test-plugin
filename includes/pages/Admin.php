<?php

/**
 * Admin Pages
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.2
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
     * To store the array of sub-pages of the plugin admin dashboard
     *
     * @var array
     */
    public $subpages = array();

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
        // Instance of the plugin's Settings_API class.
        $this->settings = new Settings_API();

        // Update the plugin's admin main page.
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

        // Update the plugin's admin sub-pages.
        $this->subpages = array(
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Post Types',
                'menu_title'    => 'Custom Post Types',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-custom-post-types',
                'callback'      => function() { echo '<h1>Custom Post Types Manager</h1>'; },
                'position'      => 0
            ),
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Taxonomies',
                'menu_title'    => 'Taxonomies',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-taxonomies',
                'callback'      => function() { echo '<h1>Taxonomies Manager</h1>'; },
                'position'      => 0
            ),
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Widgets',
                'menu_title'    => 'Widgets',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-widgets',
                'callback'      => function() { echo '<h1>Widgets Manager</h1>'; },
                'position'      => 0
            )
        );
        
        /**
         * Updates the menu position of the plugin's admin sub-pages.
         */
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
     * Adds admin pages
     * 
     * @since       0.2.0
    */
    public function register() {
        $this->settings->add_pages( $this->pages )->with_subpage( 'Dashboard' )->add_subpages( $this->subpages )->register();
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