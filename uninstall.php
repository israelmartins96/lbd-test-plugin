<?php

/**
 * 
 * Trigger this file on plugin uninstall
 * 
 * @since       0.1.0
 * 
 * @package     LbDTestPlugin
*/

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Clear plugin database data

// Access the database
global $wpdb;

$wpdb->query( 'DELETE FROM wp_posts WHERE post_type = "book"' );

$wpdb->query( 'DELETE FROM wp_postmeta WHERE post_id NOT IN ( SELECT id FROM wp_posts )' );

$wpdb->query( 'DELETE FROM wp_term_relationships WHERE object_id NOT IN ( SELECT id FROM wp_posts )' );