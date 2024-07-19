<?php

/**
 * Enqueues plugin scripts.
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\Base;

use \Includes\Base\Controller;
/**
 * Enqueues plugin scripts.
 * 
 * This class enqueues all scripts required by the plugin.
 * 
 * @since               0.2.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Enqueue extends Controller {

    /**
     * Enqueues the plugin's stylesheets and scripts
     */
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    }

    /**
     * Prepares all the plugin's stylesheets and scripts for enqueuing
    */
    // Admin
    public function enqueue_admin_scripts() {
        wp_enqueue_style( 'lbd-admin-style', $this->plugin_url . 'assets/admin/css/style.css' );
        wp_enqueue_script( 'lbd-admin-script', $this->plugin_url . 'assets/admin/js/script.js' );
    }
    
}