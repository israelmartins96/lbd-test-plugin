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
        // Fallback capabilities for when no 'capabilities' parameter is defined for a custom post type.
        $fallback_capabilities = array(
            'edit_post'                 => 'edit_post',
            'read_post'                 => 'read_post',
            'delete_post'               => 'delete_post',
            'edit_posts'                => 'edit_posts',
            'edit_others_posts'         => 'edit_others_posts',
            'delete_posts'              => 'delete_posts',
            'publish_posts'             => 'publish_posts',
            'read_private_posts'        => 'read_private_posts',
            'read'                      => 'read',
            'delete_private_posts'      => 'delete_private_posts',
            'delete_published_posts'    => 'delete_published_posts',
            'delete_others_posts'       => 'delete_others_posts',
            'edit_private_posts'        => 'edit_private_posts',
            'edit_published_posts'      => 'edit_published_posts',
            'create_posts'              => 'edit_posts'
        );

        // Fallback feature supports for when no 'supports' parameter is defined for a custom post type.
        $fallback_supports = array(
            'title',
            'editor'
        );

        // Fallback rewrite rules for when no 'rewrite' parameter is defined for a custom post type.
        $fallback_rewrite = array(
            'with_front'    => true,
            'pages'         => true,
        );
        
        foreach ( $this->custom_post_types as $post_type ) {
            // Define the other fallback rewrite parameters based on the passed custom post type parameters.
            $fallback_rewrite[] = array(
                'slug'      => $post_type['post_type'],
                'feeds'     => $post_type['has_archive'],
                'ep_mask'   => ( isset( $post_type['permalink_epmask'] ) ) ? $post_type['permalink_epmask'] : 'EP_PERMALINK'
            );
            
            // Define the custom post type labels.
            $labels = array(
                'name'                      => $post_type['name'],
                'singular_name'             => $post_type['singular_name'],
                'add_new'                   => ( isset( $post_type['add_new'] ) ) ? $post_type['add_new'] : 'Add New ' . $post_type['singular_name'],
                'add_new_item'              => ( isset( $post_type['add_new_item'] ) ) ? $post_type['add_new_item'] : 'Add New ' . $post_type['singular_name'],
                'edit_item'                 => ( isset( $post_type['edit_item'] ) ) ? $post_type['edit_item'] : 'Edit ' . $post_type['singular_name'],
                'new_item'                  => ( isset( $post_type['new_item'] ) ) ? $post_type['new_item'] : 'New ' . $post_type['singular_name'],
                'view_item'                 => ( isset( $post_type['view_item'] ) ) ? $post_type['view_item'] : 'View ' . $post_type['singular_name'],
                'view_items'                => ( isset( $post_type['view_items'] ) ) ? $post_type['view_items'] : 'View ' . $post_type['name'],
                'search_items'              => ( isset( $post_type['search_items'] ) ) ? $post_type['search_items'] : 'Search ' . $post_type['name'],
                'not_found'                 => ( isset( $post_type['not_found'] ) ) ? $post_type['not_found'] : 'No ' . strtolower( $post_type['name'] ) . ' found',
                'not_found_in_trash'        => ( isset( $post_type['not_found_in_trash'] ) ) ? $post_type['not_found_in_trash'] : 'No ' . strtolower( $post_type['name'] ) . ' found in Trash',
                'parent_item_colon'         => ( isset( $post_type['parent_item_colon'] ) ) ? $post_type['parent_item_colon'] : 'Parent ' . $post_type['singular_name'] . ':',
                'all_items'                 => ( isset( $post_type['all_items'] ) ) ? $post_type['all_items'] : 'All ' . $post_type['name'],
                'archives'                  => ( isset( $post_type['archives'] ) ) ? $post_type['archives'] : $post_type['singular_name'] . ' Archives',
                'attributes'                => ( isset( $post_type['attributes'] ) ) ? $post_type['attributes'] : $post_type['singular_name'] . ' Attributes',
                'insert_into_item'          => ( isset( $post_type['insert_into_item'] ) ) ? $post_type['insert_into_item'] : 'Insert into ' . strtolower( $post_type['singular_name'] ),
                'uploaded_to_this_item'     => ( isset( $post_type['uploaded_to_this_item'] ) ) ? $post_type['uploaded_to_this_item'] : 'Uploaded to this ' . strtolower( $post_type['singular_name'] ),
                'featured_image'            => ( isset( $post_type['featured_image'] ) ) ? $post_type['featured_image'] : 'Featured image',
                'set_featured_image'        => ( isset( $post_type['set_featured_image'] ) ) ? $post_type['set_featured_image'] : 'Set featured image',
                'remove_featured_image'     => ( isset( $post_type['remove_featured_image'] ) ) ? $post_type['remove_featured_image'] : 'Remove featured image',
                'use_featured_image'        => ( isset( $post_type['use_featured_image'] ) ) ? $post_type['use_featured_image'] : 'Use as featured image',
                'menu_name'                 => ( isset( $post_type['menu_name'] ) ) ? $post_type['menu_name'] : $post_type['name'],
                'filter_items_list'         => ( isset( $post_type['filter_items_list'] ) ) ? $post_type['filter_items_list'] : 'Filter ' . strtolower( $post_type['name'] ) . ' list',
                'filter_by_date'            => ( isset( $post_type['filter_by_date'] ) ) ? $post_type['filter_by_date'] : 'Filter by date',
                'items_list_navigation'     => ( isset( $post_type['items_list_navigation'] ) ) ? $post_type['items_list_navigation'] : $post_type['name'] . ' list navigation',
                'items_list'                => ( isset( $post_type['items_list'] ) ) ? $post_type['items_list'] : $post_type['name'] . ' list',
                'item_published'            => ( isset( $post_type['item_published'] ) ) ? $post_type['item_published'] : $post_type['singular_name'] . ' published',
                'item_published_privately'  => ( isset( $post_type['item_published_privately'] ) ) ? $post_type['item_published_privately'] : $post_type['singular_name'] . ' published privately',
                'item_reverted_to_draft'    => ( isset( $post_type['item_reverted_to_draft'] ) ) ? $post_type['item_reverted_to_draft'] : $post_type['singular_name'] . ' reverted to draft',
                'item_trashed'              => ( isset( $post_type['item_trashed'] ) ) ? $post_type['item_trashed'] : $post_type['singular_name'] . ' trashed',
                'item_scheduled'            => ( isset( $post_type['item_scheduled'] ) ) ? $post_type['item_scheduled'] : $post_type['singular_name'] . ' scheduled',
                'item_updated'              => ( isset( $post_type['item_updated'] ) ) ? $post_type['item_updated'] : $post_type['singular_name'] . ' updated',
                'item_link'                 => ( isset( $post_type['item_link'] ) ) ? $post_type['item_link'] : $post_type['singular_name'] . ' Link',
                'item_link_description'     => ( isset( $post_type['item_link_description'] ) ) ? $post_type['item_link_description'] : 'A link to a ' . strtolower( $post_type['singular_name'] )
            );
            
            // Define the custom post type parameters to be registered.
            $args = array(
                'labels'                            => $labels,
                'description'                       => ( isset( $post_type['description'] ) ) ? $post_type['description'] : 'A short summary of what the ' . $post_type['name'] . ' post type is.',
                'public'                            => ( isset( $post_type['public'] ) ) ? $post_type['public'] : false,
                'hierarchical'                      => ( isset( $post_type['hierarchical'] ) ) ? $post_type['hierarchical'] : false,
                'exclude_from_search'               => ( isset( $post_type['exclude_from_search'] ) ) ? $post_type['exclude_from_search'] : ( ( isset( $post_type['public'] ) ) ? ( ! $post_type['public'] ) : true ),
                'publicly_queryable'                => ( isset( $post_type['publicly_queryable'] ) ) ? $post_type['publicly_queryable'] : ( ( isset( $post_type['public'] ) ) ? $post_type['public'] : false ),
                'show_ui'                           => ( isset( $post_type['show_ui'] ) ) ? $post_type['show_ui'] : ( ( isset( $post_type['public'] ) ) ? $post_type['public'] : false ),
                'show_in_menu'                      => ( isset( $post_type['show_in_menu'] ) ) ? $post_type['show_in_menu'] : ( ( isset( $post_type['show_ui'] ) ) ? $post_type['show_ui'] : false ),
                'show_in_nav_menus'                 => ( isset( $post_type['show_in_nav_menus'] ) ) ? $post_type['show_in_nav_menus'] : ( ( isset( $post_type['public'] ) ) ? $post_type['public'] : false ),
                'show_in_admin_bar'                 => ( isset( $post_type['show_in_admin_bar'] ) ) ? $post_type['show_in_admin_bar'] : ( ( isset( $post_type['show_in_menu'] ) ) ? $post_type['show_in_menu'] : false ),
                'show_in_rest'                      => ( isset( $post_type['show_in_rest'] ) ) ? $post_type['show_in_rest'] : true,
                'rest_base'                         => ( isset( $post_type['rest_base'] ) ) ? $post_type['rest_base'] : $post_type['post_type'],
                'rest_namespace'                    => ( isset( $post_type['rest_namespace'] ) ) ? $post_type['rest_namespace'] : 'wp/v2',
                'rest_controller_class'             => ( isset( $post_type['rest_controller_class'] ) ) ? $post_type['rest_controller_class'] : 'WP_REST_Posts_Controller',
                'autosave_rest_controller_class'    => ( isset( $post_type['autosave_rest_controller_class'] ) ) ? $post_type['autosave_rest_controller_class'] : 'WP_REST_Autosaves_Controller',
                'revisions_rest_controller_class'   => ( isset( $post_type['revisions_rest_controller_class'] ) ) ? $post_type['revisions_rest_controller_class'] : 'WP_REST_Revisions_Controller',
                'late_route_registration'           => ( isset( $post_type['late_route_registration'] ) ) ? $post_type['late_route_registration'] : true,
                'menu_position'                     => ( isset( $post_type['menu_position'] ) ) ? $post_type['menu_position'] : null,
                'menu_icon'                         => ( isset( $post_type['menu_icon'] ) ) ? $post_type['menu_icon'] : 'dashicons-admin-post',
                'capability_type'                   => ( isset( $post_type['capability_type'] ) ) ? $post_type['capability_type'] : 'post',
                'capabilities'                      => ( isset( $post_type['capabilities'] ) ) ? ( ( ! empty( $post_type['capabilities'] ) ) ? $post_type['capabilities'] : $fallback_capabilities ) : $fallback_capabilities,
                'map_meta_cap'                      => ( isset( $post_type['map_meta_cap'] ) ) ? $post_type['map_meta_cap'] : false,
                'supports'                          => ( isset( $post_type['supports'] ) ) ? ( ( ! empty( $post_type['supports'] ) ) ? $post_type['supports'] : $fallback_supports ) : $fallback_supports,
                'register_meta_box_cb'              => ( isset( $post_type['register_meta_box_cb'] ) ) ? $post_type['register_meta_box_cb'] : null,
                'taxonomies'                        => ( isset( $post_type['taxonomies'] ) ) ? ( ( ! empty( $post_type['taxonomies'] ) ) ? $post_type['taxonomies'] : array() ) : array(),
                'has_archive'                       => ( isset( $post_type['has_archive'] ) ) ? $post_type['has_archive'] : false,
                'rewrite'                           => ( isset( $post_type['rewrite'] ) ) ? $post_type['rewrite'] : $fallback_rewrite,
                'query_var'                         => ( isset( $post_type['query_var'] ) ) ? $post_type['query_var'] : $post_type['post_type'],
                'can_export'                        => ( isset( $post_type['can_export'] ) ) ? $post_type['can_export'] : true,
                'delete_with_user'                  => ( isset( $post_type['delete_with_user'] ) ) ? $post_type['delete_with_user'] : null,
                'template'                          => ( isset( $post_type['template'] ) ) ? $post_type['template'] : array(),
                'template_lock'                     => ( isset( $post_type['template_lock'] ) ) ? $post_type['template_lock'] : false
            );

            // Register the custom post type.
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