<?php

/**
 * Plugin Post Type Controller
 * 
 * @since               0.3.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\Base\Controller;

use \Includes\Base\Controller\Controller;
use \Includes\API\Settings_API;
use \Includes\API\Callbacks\Admin_Callbacks;
/**
 * Plugin Post Type Controller class.
 * 
 * Plugin Post Type Controller class.
 * 
 * @since               0.3.0
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Post_Type extends Controller {
    /**
     * To store an instance of the Settings_API.
     *
     * @var object
     */
    public $settings_API;

    /**
     * To store an instance of the Admin_Callbacks.
     *
     * @var object
     */
    public $callbacks;

    /**
     * To store the array of sub-pages of the custom post type.
     *
     * @var array
     */
    public $subpages = array();

    /**
     * Prepares and adds the custom post type.
     *
     * @return void
     */
    public function register() {
        // Set the settings section ID.
        $this->settings_section_id = 'cpt-mgmt';
        
        // Do not load the custom post type and it's management section if its option is not activated.
        if ( ! $this->is_settings_section_activated( $this->settings_section_id ) ) {
            return;
        }
        
        // Instance of the plugin's Settings_API class.
        $this->settings_API = new Settings_API();

        // Instance of the plugin's Admin_Callbacks class.
        $this->callbacks = new Admin_Callbacks();

        // Sets the sub-pages.
        $this->set_subpages();

        // Adds the sub-pages.
        $this->settings_API->add_subpages( $this->subpages )->register();
        
        // Creates the custom post type when WordPress is initialised.
        add_action( 'init', array( $this, 'activate' ) );
    }

    /**
     * Activates/Creates the custom post type.
     *
     * @return void
     */
    public function activate() {
        $args = array(
            'labels'        => array(
                'name'          => 'Products',
                'singular_name' => 'Product'
            ),
            'public'        => true,
            'has_archive'   => true
        );
        
        register_post_type( 'lbd_cpt', $args );
    }

    /**
     * Popuplates the sub-pages array.
     *
     * @return void
     */
    public function set_subpages() {
        $this->subpages = array(
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Post Types',
                'menu_title'    => 'Custom Post Types Manager',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-custom-post-types',
                'callback'      => array( $this->callbacks, 'custom_post_types_dashboard' ),
                'position'      => 1
            )
        );

        // Sequentially update the menu positions of the plugin's admin sub-pages.
        $this->set_subpages_positions( $this->subpages );
    }
}