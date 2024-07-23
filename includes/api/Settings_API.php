<?php

/**
 * Settings API
 * 
 * @since               0.2.3
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
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
     * Array of admin pages.
     *
     * @var array
     */
    public $admin_pages = array();

    /**
     * Adds the admin menu
     *
     * @return void
     */
    public function register() {
        if ( ! empty( $this->admin_pages ) ) {
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
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
     * Prepares the admin menu pages from an array of admin pages
     *
     * @return void
     */
    public function add_admin_menu() {
        foreach ( $this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
        }
    }
    
}