<?php

/**
 * Fired during plugin activation
 * 
 * @since               0.1.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.2.0
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
        
        self::preset_lbd_values();
    }

    /**
     * Sets plugin options.
     *
     * @since       0.3.2
     */
    public static function preset_lbd_values() {
        $preset_cpt_value = array(
            'example' => array(
                            'post-type-id'         => 'example',
                            'plural-name'              => 'Examples',
                            'singular-name'     => 'Example',
                            'public'            => false,
                            'has-archive'       => false
                        )
        );
        
        self::preset_lbd_option( 'lbd-plugin', array() );
        self::preset_lbd_option( 'lbd-custom-post-type', $preset_cpt_value );
    }

    /**
     * Checks and updates/creates a plugin option if the option does not exist.
     * 
     * @param string $option
     * @param mixed $value
     * 
     * @since       0.3.2
     */
    public static function preset_lbd_option( $option, $value ) {
        if ( get_option( $option ) ) {
            return;
        }

        update_option($option, $value, null);
    }

}