<?php

/**
 * Plugin post type settings callbacks
 * 
 * @since               0.3.2
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\API\Callbacks;

/**
 * Plugin post type settings callbacks class.
 * 
 * Plugin post type settings callbacks class.
 * 
 * @since               0.3.2
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Post_Type_Callbacks {

    /**
     * Displays post types settings dashboard description.
     *
     * @return void
     */
    public function cpt_section() {
        echo 'Manage the custom post types of the plugin.';
    }

    /**
     * Undocumented function
     *
     * @param [type] $input
     * @return void
     */
    public function cpt_sanitise( $input ) {
        return $input;
    }

    /**
     * Prepares the text fields markup template.
     *
     * @param array $args
     * @return void
     */
    public function cpt_text_field( $args ) {
        $option_name = $args[ 'option_name' ];
        $option = get_option( $option_name, $option_name );
        $placeholder = $args[ 'placeholder' ];
        $section_id = $args[ 'label_for' ];
        $text_field_classes = 'regular-text text-field';

        $name = $option_name . '[' . $section_id . ']';
        $section = isset( $option[ $section_id ] ) ? $option[ $section_id ] : '';
        
        $text_field = '<input type="text" id="' . $section_id . '" class="' . $text_field_classes . '" name="' . $name . '" value="' . $section . '" placeholder="' . $placeholder . '" />';

        $text_field_label = '<label for="' . $section_id . '" ></label>';

        echo '<div class="text-field-container">' . $text_field_label . $text_field . '</div>';
    }

    /**
     * Prepares the checkbox fields markup template.
     *
     * @param array $args
     * @return void
     */
    public function cpt_checkbox_field( $args ) {
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