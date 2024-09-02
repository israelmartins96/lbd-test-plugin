<?php

/**
 * Plugin management settings callbacks
 * 
 * @since               0.2.8
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\API\Callbacks;

use \Includes\Base\Controller;

/**
 * Plugin management settings callbacks class.
 * 
 * Plugin management settings callbacks class.
 * 
 * @since               0.2.8
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Management_Callbacks extends Controller {

    /**
     * Callback for the lbd_plugin_settings. Sanitises the options checkboxes.
     *
     * @param [type] $input
     * @return void
     */
    public function lbd_checkbox_sanitise( $input ) {
        return ( isset( $input ) ? true : false );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function lbd_admin_manager() {
        echo 'Manage the sections and features of the plugin.';
    }

    public function lbd_settings_checkbox( $args ) {
        $classes = esc_attr( $args[ 'class' ] );
        $name = esc_attr( $args[ 'label_for' ] );
        $value = get_option( $name );
        
        $checkbox = '<input type="checkbox" id="' . $name . '" class="' . $classes . '" name="' . $name . '" value="1" placeholder="Type here..."' . ( $value ? 'checked="checked"' : '' ) . ' />';

        echo $checkbox;
    }
    
}