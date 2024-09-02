<?php

/**
 * This template displays the plugin's admin dashboard page.
 * 
 * @since               0.2.1
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Templates
 * @version             0.1.1
 */

?>

<div class="pagewrap">
    <!-- Screen Header Section -->
    <div class="lbd-admin-header pad-top-1 pad-right-2 pad-bottom-quart">
        <!-- Screen Heading -->
        <h1 class="screen-heading pad-left-2">LBD Plugin Dashboard</h1>
        <!-- /Screen Heading -->
        
        <!-- Settings Tabs -->
        <nav class="nav nav-tabs pad-left-2" aria-label="Secondary menu">
            <a href="#tab-1" class="tab active">Manage Settings</a>
            <a href="#tab-2" class="tab">Updates</a>
            <a href="#tab-3" class="tab">About</a>
        </nav>
        <!-- /Settings Tabs -->
    </div>
    <!-- /Screen Header Section -->

    <!-- Tab Content -->
    <div class="tab-content pad-top-1 pad-right-2 pad-left-2">
        <?php
        // Settings Feedback
        settings_errors();
        ?>
        
        <!-- First Tab -->
        <div id="tab-1" class="tab-pane active">
            <!-- Settings Fields -->
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'lbd_plugin_settings' );
                    do_settings_sections( 'lbd-plugin' );
                    submit_button();
                ?>
            </form>
            <!-- /Settings Fields -->
        </div>
        <!-- /First Tab -->
        
        <!-- Second Tab -->
        <div id="tab-2" class="tab-pane">
            <h3>Updates</h3>
        </div>
        <!-- /Second Tab -->
        
        <!-- Third Tab -->
        <div id="tab-3" class="tab-pane">
            <h3>About</h3>
        </div>
        <!-- /Third Tab -->
    </div>
    <!-- /Tab Content -->
</div>