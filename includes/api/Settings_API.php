<?php

/**
 * Settings API
 * 
 * @since               0.2.3
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\API;

/**
 * Settings API class.
 * 
 * Settings API class.
 * 
 * @since               0.2.3
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Settings_API {
    
    /**
     * Array of admin pages.
     *
     * @var array
     */
    public $admin_pages = array();
    
    /**
     * Array of plugin admin sub-pages.
     *
     * @var array
     */
    public $admin_subpages = array();

    /**
     * Adds the admin menu
     *
     * @return void
     */
    public function register() {
        if ( ! empty( $this->admin_pages ) ) {
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        }
    }
    
    /**
     * Updates the array of admin pages.
     *
     * @param array $pages
     * @return void
     */
    public function add_pages( array $pages ) {
        $this->admin_pages = $pages;

        return $this;
    }

    /**
     * Adds the main sub-page of the plugin admin dashboard
     *
     * @param string $title
     * @return void
     */
    public function with_subpage( string $title = null ) {
        if ( empty( $this->admin_pages ) ) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug'   => $admin_page['menu_slug'],
                'page_title'    => $admin_page['page_title'],
                'menu_title'    => $title ? $title : $admin_page['menu_title'],
                'capability'    => $admin_page['capability'],
                'menu_slug'     => $admin_page['menu_slug'],
                'callback'      => $admin_page['callback'],
                'position'      => 1
            )
        );

        $this->admin_subpages = $subpage;

        return $this;
    }

    /**
     * Updates the array of admin sub-pages.
     *
     * @param array $pages
     * @return void
     */
    public function add_subpages( array $pages ) {
        $subpages_count = count( $this->admin_subpages );
        
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages );

        for ( $i = 0; $i < $subpages_count; $i++ ) {
            $position = $i + 1;

            ?><pre><?php // print_r( $this->admin_subpages[ $i ]['position'] );?></pre><?php
            
            // array_merge( $pages[ $i ], array( 'position' => $position ) );
        }

        ?><pre><?php // print_r( $this->admin_subpages );?></pre><?php

        return $this;
    }

    /**
     * Prepares the admin menu pages from an arrays of admin pages
     *
     * @return void
     */
    public function add_admin_menu() {
        // Admin menu page
        foreach ( $this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
        }

        // Main sub-page
        foreach ( $this->admin_subpages as $subpage ) {
            add_submenu_page( $subpage['parent_slug'], $subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['callback'], $subpage['position'] );
        }
    }
    
}