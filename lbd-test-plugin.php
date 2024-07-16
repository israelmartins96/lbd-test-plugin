<?php

/**
 * LbD Test Plugin
 *
 * @package             LBD_Test_Plugin
 * @author              Israel Martins
 * @copyright           Copyright (c) 2024, Lightbulb Devs
 * @license             GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:         LBD Test Plugin
 * Plugin URI:          https://israelmartins.com
 * Description:         A test plugin.
 * Version:             0.1.1
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Israel Martins
 * Author URI:          https://israelmartins.com
 * Donate link:         https://israelmartins.com/donate/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:          https://israelmartins.com
 * Text Domain:         lbd-test-plugin
 * Domain Path:         /languages/
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2024 Lightbulb Devs
*/

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LBD_Test_Plugin' ) ) {
    class LBD_Test_Plugin {

        /**
         * On plugin activation
        */
        function activate() {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-lbd-plugin-activator.php';
            LBD_Plugin_Activator::activate();
        }

        /**
         * On plugin deactivation
        */
        function deactivate() {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-lbd-plugin-deactivator.php';
            LBD_Plugin_Deactivator::deactivate();
        }

        /**
         * Create post type.
        */
        protected function create_post_type() {
            // Register post type
            add_action( 'init', array( $this, 'register_custom_post_type' ) );
        }

        /**
        * Registers custom post type
        */
        function register_custom_post_type() {
            $args = array(
                'label'     => 'Books',
                'public'    => true
            );

            register_post_type( 'book', $args );
        }

        /**
         * Initialises admin sections
        */
        function admin_init() {
            // Actions
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        }

        /**
         * Enqueues all plugin stylesheets and scripts
        */
        // Admin
        function enqueue_admin_scripts() {
            wp_enqueue_style( 'lbd-admin-style', plugins_url( '/assets/admin/css/style.css', __FILE__ ) );
            wp_enqueue_script( 'lbd-admin-script', plugins_url( '/assets/admin/js/script.js', __FILE__ ) );
        }

        /**
         * Adds admin pages
        */
        function add_admin_pages() {
            $menu_icon_src = file_get_contents( plugin_dir_path( __FILE__ ) . 'assets/admin/icons/lbd-icon.svg' );

            $menu_icon = 'data:image/svg+xml;base64,' . base64_encode( $menu_icon_src );
            
            add_menu_page( 'LBD Plugin', 'LBD', 'manage_options', 'lbd-plugin', array( $this, 'admin_index' ), $menu_icon, 110 );
        }

        /**
         * Admin index page
        */
        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin/admin.php';
        }

    }

    /**
     * Initialise plugin
    */
    $lbd_test_plugin = new LBD_Test_Plugin();
    $lbd_test_plugin->admin_init();

    // Register plugin activation hook
    register_activation_hook( __FILE__, array( $lbd_test_plugin, 'activate' ) );

    // Register plugin deactivation hook
    register_deactivation_hook( __FILE__, array( $lbd_test_plugin, 'deactivate' ) );
}