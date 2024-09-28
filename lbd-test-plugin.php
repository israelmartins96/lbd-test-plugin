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
 * Version:             0.2.12
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

/**
 * Abort if this file is accessed directly.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Current plugin version.
 * 
 * @since   0.2.5
 */
define( 'LBD_VERSION', '0.2.12' );

/**
 * Plugin name constant.
 * 
 * @since   0.2.1
 */
define( 'PLUGIN', plugin_basename( __FILE__ ) );

/**
 * Plugin root path constant.
 * 
 * @since   0.2.0
 */
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin URL constant.
 * 
 * @since   0.2.0
 */
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Plugin admin pages suffix constant.
 * 
 * @since   0.2.7
 */
define( 'PLUGIN_ADMIN_SUFFIX', '_lbd-' );

/**
 * Require Composer Autoload.
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * To run during plugin activation.
 */
function lbd_plugin_activate() {
    Includes\Base\Activate::activate();
}

/**
 * Register activation hook.
 */
register_activation_hook( __FILE__, 'lbd_plugin_activate');

/**
 * To run during plugin deactivation.
 */
function lbd_plugin_deactivate() {
    Includes\Base\Deactivate::deactivate();
}

/**
 * Register deactivation hook.
 */
register_deactivation_hook( __FILE__, 'lbd_plugin_deactivate');

/**
 * Register plugin classes as services if the Init class exists.
 */
if ( class_exists( 'Includes\\Init' ) ) {
    Includes\Init::register_services();
}