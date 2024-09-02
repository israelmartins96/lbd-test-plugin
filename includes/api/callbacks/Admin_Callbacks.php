<?php

/**
 * Plugin callbacks
 * 
 * @since               0.2.5
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\API\Callbacks;

use \Includes\Base\Controller;

/**
 * Plugin callbacks class.
 * 
 * Plugin callbacks class.
 * 
 * @since               0.2.5
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Admin_Callbacks extends Controller {

    /**
     * Renders the plugin's admin dashboard page.
     *
     * @return require_once $lbd_dashboard
     */
    public function lbd_dashboard() {
        $lbd_dashboard = $this->plugin_path . 'templates/admin/admin.php';
        
        return require_once $lbd_dashboard;
    }

    /**
     * Renders the plugin's custom post types management page.
     *
     * @return require_once $custom_post_types_dashboard
     */
    public function custom_post_types_dashboard() {
        $custom_post_types_dashboard = $this->plugin_path . 'templates/admin/custom-post-types.php';
        
        return require_once $custom_post_types_dashboard;
    }

    /**
     * Renders the plugin's taxonomies management page.
     *
     * @return require_once $taxonomies_dashboard
     */
    public function taxonomies_dashboard() {
        $taxonomies_dashboard = $this->plugin_path . 'templates/admin/taxonomies.php';
        
        return require_once $taxonomies_dashboard;
    }

    /**
     * Renders the plugin's widgets management page.
     *
     * @return return_once $widgets_dashboard
     */
    public function widgets_dashboard() {
        $widgets_dashboard = $this->plugin_path . 'templates/admin/widgets.php';

        return require_once $widgets_dashboard;
    }

    /**
     * Renders the custom field for the text-example custom option.
     *
     * @return void
     */
    public function lbd_text_example() {
        $value = esc_attr( get_option( 'text-example' ) );
        
        echo '<input type="text" class="regular-text" name="text-example" value="' . $value . '" placeholder="Type here..." />';
    }

    /**
     * Renders the custom field for the first-name custom option.
     *
     * @return void
     */
    public function lbd_first_name() {
        $value = esc_attr( get_option( 'first-name' ) );

        echo '<input type="text" class="regular-text" name="first-name" value="' . $value . '" placeholder="e.g., John Joe" />';
    }
    
}