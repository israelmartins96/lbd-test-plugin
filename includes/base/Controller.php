<?php

/**
 * Plugin Controller
 * 
 * @since               0.2.2
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @version             0.1.0
 */
namespace Includes\Base;

/**
 * Plugin Controller class.
 * 
 * Plugin Controller class.
 * 
 * @since               0.2.2
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Classes
 * @author              Israel Martins <m.oisrael96@gmail.com>
 */
class Controller {

    /**
     * Prepared to store the plugin's name/unique identifier.
     *
     * @var string
     */
    public $plugin;
    
    /**
     * Prepared to store the plugin's base path.
     *
     * @var string
     */
    public $plugin_path;

    /**
     * Prepared to store the plugin's URL.
     *
     * @var string
     */
    public $plugin_url;

    /**
     * Plugin base file name
     *
     * @var string
     */
    private $plugin_filename = '/lbd-test-plugin.php';

    /**
     * Class constructor
     */
    public function __construct() {
        $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . $this->plugin_filename;
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
    }
    
}