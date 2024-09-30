<?php

/**
 * Initialises plugin classes as services.
 * 
 * @since               0.2.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes;

/**
 * Initialises plugin classes as services.
 * 
 * This class initialises the plugin classes as services to enable all functionalities of the plugin.
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
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\Action_Links::class,
            Base\Controller\Post_Type::class
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