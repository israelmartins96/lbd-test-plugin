<?php

/**
 * Plugin callbacks
 * 
 * @since               0.2.5
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.3
 */
namespace Includes\API\Callbacks;

use \Includes\Base\Controller\Controller;

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
     * @return require_once $custom_post_type_dashboard
     */
    public function custom_post_type_dashboard() {
        $custom_post_type_dashboard = $this->plugin_path . 'templates/admin/custom-post-type.php';
        
        return require_once $custom_post_type_dashboard;
    }

    /**
     * Renders the plugin's taxonomies management page.
     *
     * @return require_once $taxonomies_dashboard
     */
    public function taxonomy_dashboard() {
        $taxonomy_dashboard = $this->plugin_path . 'templates/admin/taxonomy.php';
        
        return require_once $taxonomy_dashboard;
    }

    /**
     * Renders the plugin's widgets management page.
     *
     * @return return_once $media_widget_dashboard
     */
    public function media_widget_dashboard() {
        $media_widget_dashboard = $this->plugin_path . 'templates/admin/media-widget.php';

        return require_once $media_widget_dashboard;
    }

    /**
     * Renders the plugin's gallery management page.
     *
     * @return return_once $gallery_dashboard
     */
    public function gallery_dashboard() {
        $gallery_dashboard = $this->plugin_path . 'templates/admin/gallery.php';

        return require_once $gallery_dashboard;
    }

    /**
     * Renders the plugin's testimonials management page.
     *
     * @return return_once $testimonial_dashboard
     */
    public function testimonial_dashboard() {
        $testimonial_dashboard = $this->plugin_path . 'templates/admin/testimonial.php';

        return require_once $testimonial_dashboard;
    }

    /**
     * Renders the plugin's custom template management page.
     *
     * @return return_once $custom_template_dashboard
     */
    public function custom_template_dashboard() {
        $custom_template_dashboard = $this->plugin_path . 'templates/admin/custom-template.php';

        return require_once $custom_template_dashboard;
    }

    /**
     * Renders the plugin's AJAX login management page.
     *
     * @return return_once $ajax_login_dashboard
     */
    public function ajax_login_dashboard() {
        $ajax_login_dashboard = $this->plugin_path . 'templates/admin/ajax-login.php';

        return require_once $ajax_login_dashboard;
    }

    /**
     * Renders the plugin's membership management page.
     *
     * @return return_once $membership_dashboard
     */
    public function membership_dashboard() {
        $membership_dashboard = $this->plugin_path . 'templates/admin/membership.php';

        return require_once $membership_dashboard;
    }

    /**
     * Renders the plugin's chat management page.
     *
     * @return return_once $chat_dashboard
     */
    public function chat_dashboard() {
        $chat_dashboard = $this->plugin_path . 'templates/admin/chat.php';

        return require_once $chat_dashboard;
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