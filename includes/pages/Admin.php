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
     * Adds admin page
     * 
     * @since       0.2.0
    */
    public function register() {
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
    }

    /**
     * Adds admin pages
     * 
     * @since       0.2.0
    */
    public function add_admin_pages() {
        $menu_icon_src = file_get_contents( $this->plugin_path . 'assets/admin/icons/lbd-icon.svg' );

        $menu_icon = 'data:image/svg+xml;base64,' . base64_encode( $menu_icon_src );
        
        add_menu_page( 'LBD Plugin', 'LBD', 'manage_options', 'lbd-plugin', array( $this, 'add_admin_index' ), $menu_icon, 110 );
    }

    /**
     * Admin index page
     * 
     * @since       0.2.0
    */
    public function add_admin_index() {
        require_once $this->plugin_path . 'templates/admin/admin.php';
    }
    
}