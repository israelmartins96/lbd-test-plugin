<?php

/**
 * Updates plugin action links.
 * 
 * @since               0.2.1
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.1
 */
namespace Includes\Base;

use \Includes\Base\Controller;

/**
 * Updates plugin action links.
 * 
 * This class controls the action link(s) for the plugin on the All Plugins page.
 * 
 * @since               0.2.1
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Action_Links extends Controller {
    
    /**
     * Customises the plugin action link(s) on All Plugins page.
     */
    public function register() {
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'add_action_link' ) );
    }

    /**
     * Prepares the plugin action link to be updated.
     *
     * @param array $links array of plugin actions links.
     * @return void
     */
    public function add_action_link( $links ) {
        $action_link = '<a href="admin.php?page=lbd-plugin">Settings</a>';

        array_push( $links, $action_link );

        return $links;
    }
    
}