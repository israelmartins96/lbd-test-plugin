<?php

/**
 * Plugin management settings callbacks
 * 
 * @since               0.2.8
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.2
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
        $output = array();

        foreach ( $this->settings_options as $option_id => $value ) {
            $output[ $option_id ] = ( isset( $input[ $option_id ] ) ? true : false );
        }
        
        return $output;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function lbd_admin_manager() {
        echo 'Manage the sections and features of the plugin.';
    }

    /**
     * Admin options checkbox markup.
     *
     * @param array $args
     * @return void
     */
    public function lbd_settings_checkbox( $args ) {
        $checkbox_classes = 'toggle-checkbox';
        $feature_id = $args[ 'label_for' ];
        $option_name = $args[ 'option_name' ];
        $value = get_option( $option_name, $option_name );

        $is_checked = isset( $value[ $feature_id ] ) ? ( ( $value[ $feature_id ] ? true : false ) ) : false;
        
        $checkbox = '<input type="checkbox" id="' . $feature_id . '" class="' . $checkbox_classes . '" name="' . $option_name . '[' . $feature_id . ']' . '" value="1" placeholder="Type here..."' . ( $is_checked ? 'checked="checked"' : '' ) . ' />';

        $checkbox_label = '<label for="' . $feature_id . '" class="toggle-switch"></label>';

        echo '<div class="toggle-switch-container">' . $checkbox . $checkbox_label . '</div>';
    }
    
}