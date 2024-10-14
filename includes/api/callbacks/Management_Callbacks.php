<?php

/**
 * Plugin management settings callbacks
 * 
 * @since               0.2.8
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.3
 */
namespace Includes\API\Callbacks;

use \Includes\Base\Controller\Controller;

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

        foreach ( $this->settings_sections as $section_id => $option ) {
            $output[ $section_id ] = ( isset( $input[ $section_id ] ) ? true : false );
        }
        
        return $output;
    }

    /**
     * Displays plugin settings dashboard description.
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
        $option_name = $args[ 'option_name' ];
        $option = get_option( $option_name, $option_name );
        $section_id = $args[ 'label_for' ];

        $is_checked = isset( $option[ $section_id ] ) ? ( ( $option[ $section_id ] ? true : false ) ) : false;
        $name = $option_name . '[' . $section_id . ']';
        
        $checkbox = '<input type="checkbox" id="' . $section_id . '" class="' . $checkbox_classes . '" name="' . $name . '" value="1"' . ( $is_checked ? 'checked="checked"' : '' ) . ' />';

        $checkbox_label = '<label for="' . $section_id . '" class="toggle-switch"></label>';

        echo '<div class="toggle-switch-container">' . $checkbox . $checkbox_label . '</div>';
    }
    
}