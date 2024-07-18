<?php

/**
 * Fired during plugin activation
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes;

/**
 * Fired during plugin activation.
 * 
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @since               0.2.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
final class Init {
    
    /**
     * Store all classes in an array.
     * 
     * @return      array full list of classes.
     * @since       0.2.0
    */
    public static function get_services() {
        $services = array(
            Pages\Admin::class,
            Base\Enqueue::class
        );
        
        return $services;
    }
    
    /**
     * Loop through classes, initialise each, and call the register() method if it exists.
     * 
     * @since       0.2.0
    */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );

            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Creates new instance of a class.
     * 
     * @param       class $class
     * @return      class new instance of the class
     * @since       0.2.0
    */
    private static function instantiate( $class ) {
        $service = new $class();

        return $service;
    }

}