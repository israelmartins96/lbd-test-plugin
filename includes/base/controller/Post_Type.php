<?php

/**
 * Plugin Post Type Controller
 * 
 * @since               0.3.0
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
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
     * To store the custom post types added by the plugin.
     *
     * @var array
     */
    public $custom_post_types = array();

    /**
     * Prepares and adds the custom post type.
     *
     * @return void
     */
    public function register() {
        // Set the settings section ID.
        $this->settings_section_id = 'custom-post-type-mgmt';
        
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

        // Store/Update the added cutom post types.
        $this->store_custom_post_types();

        if ( ! empty( $this->custom_post_types ) ) {
            // Creates the custom post type(s) when WordPress is initialised.
            add_action( 'init', array( $this, 'register_custom_post_types' ) );
        }
    }

    /**
     * Populates the multidimensional array of custom post types to be registered.
     *
     * @return void
     */
    public function store_custom_post_types() {
        $this->custom_post_types = array(
            array(
                'post_type'     => 'lbd-product',
                'name'          => 'Products',
                'singular_name' => 'Product',
                'public'        => true,
                'has_archive'   => true
            ),
            array(
                'post_type'     => 'lbd-comic',
                'name'          => 'Comics',
                'singular_name' => 'Comic',
                'public'        => true,
                'has_archive'   => true
            )
        );
    }

    /**
     * Activates/Creates the custom post type.
     *
     * @return void
     */
    public function register_custom_post_types() {
        foreach ( $this->custom_post_types as $post_type ) {
            $args = array(
                'labels'        => array(
                    'name'          => $post_type['name'],
                    'singular_name' => $post_type['singular_name']
                ),
                'public'        => $post_type['public'],
                'has_archive'   => $post_type['has_archive']
            );

            register_post_type( $post_type['post_type'], $args);
        }
    }

    /**
     * Sets the settings sub-page(s).
     *
     * @return void
     */
    public function set_subpages() {
        $this->subpages = array(
            array(
                'parent_slug'   => 'lbd-plugin',
                'page_title'    => 'Custom Post Types',
                'menu_title'    => 'Custom Post Types',
                'capability'    => 'manage_options',
                'menu_slug'     => 'lbd-custom-post-type',
                'callback'      => array( $this->callbacks, 'custom_post_type_dashboard' ),
                'position'      => 1
            )
        );

        // Sequentially update the menu positions of the plugin's admin sub-pages.
        $this->set_subpages_positions( $this->subpages );
    }
}