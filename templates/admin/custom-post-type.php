<?php

/**
 * This template displays the plugin's custom post type management page in the WP Admin.
 * 
 * @since               0.2.5
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Templates
 * @version             0.2.0
 */

?>

<div class="pagewrap">
    <!-- Screen Header Section -->
    <div class="lbd-admin-header">
        <!-- Screen Heading -->
        <h1 class="screen-heading">Custom Post Types Manager</h1>
        <!-- /Screen Heading -->
    </div>
    <!-- /Screen Header Section -->
    
    <!-- Settings Options Area -->
    <div class="admin-settings-body">
        <?php
            // Settings Feedback
            settings_errors();
        ?>

        <!-- Settings Fields -->
        <form method="post" action="options.php">
            <?php
                settings_fields( 'lbd_plugin_cpt_settings' );
                do_settings_sections( 'lbd-custom-post-type' );
                submit_button();
            ?>
        </form>
        <!-- /Settings Fields -->
    </div>
    <!-- /Settings Options Area -->
</div>