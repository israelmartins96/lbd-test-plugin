<?php

/**
 * Fired during plugin deactivation
 * 
 * @since               0.1.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\Base;

/**
 * Fired during plugin deactivation.
 * 
 * This class defines all code necessary to run during the plugin's deactivation.
 * 
 * @since               0.1.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Deactivate {
    
    /**
     * Ensures that WordPress rewrite rules are refreshed when the plugin is deactivated.
     * 
     * @since       0.1.0
    */
    public static function deactivate() {
        flush_rewrite_rules();
    }

}