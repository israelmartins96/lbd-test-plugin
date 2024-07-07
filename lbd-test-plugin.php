<?php
/**
 * LbD Test Plugin
 *
 * @package             LbDTestPlugin
 * @author              Israel Martins
 * @copyright           Copyright (c) 2024, Lightbulb Devs
 * @license             GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:         LbD Test Plugin
 * Plugin URI:          https://israelmartins.com
 * Description:         A test plugin
 * Version:             0.1.0
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

class LBD_Test_Plugin {

    /**
    * LBD Test Plugin Constructor
    */
    public function __construct() {

        $this->init_hooks();

    }

    /**
    * When the plugin is activated
    */
    public static function activate() {

        // Register custom post type (CPT)
        $this->register_custom_post_type();

        // Fluch rewrite rules
        flush_rewrite_rules();

    }

    /**
    * When the plugin is deactivated
    */
    public static function deactivate() {

        // Flush rewrite rules
        flush_rewrite_rules();

    }

    /**
    * When the plugin is uninstalled
    */
    public static function uninstall() {

        // Delete CPT

        // Delete plugin data from DB

    }

    /**
    * Hook into actions and filters
    */
    private function init_hooks() {

        // Register plugin activation hook
        register_activation_hook( __FILE__, array( $this, 'activate' ) );

        // Register plugin deactivation hook
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        // Register plugin uninstallation hook

        // Register post type
        add_action( 'init', array( $this, 'register_custom_post_type' ) );

    }

    /**
    * Registers custom post type
    */
    public function register_custom_post_type() {

        $args = array(
            'label'     => 'Books',
            'public'    => true
        );

        register_post_type( 'book', $args );
    }

}

// Initiate plugin
if ( class_exists( 'LBD_Test_Plugin' ) ) {
    $lbd_test_plugin = new LBD_Test_Plugin();
}
