<?php

/**
 * Fired during plugin activation
 * 
 * @since               0.1.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\Base;

/**
 * Fired during plugin activation.
 * 
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @since               0.1.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Activate {
    
    /**
     * Ensures that WordPress rewrite rules are refreshed when the plugin is activated.
     * 
     * @since       0.1.0
    */
    public static function activate() {        
        flush_rewrite_rules();
        
        $lbd_option = 'lbd-plugin';
        $lbd_option_value = array();
        
        if ( get_option( $lbd_option ) ) {
            return;
        }

        update_option($lbd_option, $lbd_option_value, null);
    }

}