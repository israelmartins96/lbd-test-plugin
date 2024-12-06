<?php

/**
 * This template displays the plugin's custom post type management page in the WP Admin.
 * 
 * @since               0.2.5
 *
 * @package             LBD_Test_Plugin
 * @subpackage          LBD_Test_Plugin/Templates
 * @version             0.3.0
 */

?>

<div class="pagewrap">
    <!-- Screen Header Section -->
    <div class="lbd-admin-header">
        <!-- Screen Heading -->
        <h1 class="screen-heading">Custom Post Types Manager</h1>
        <!-- /Screen Heading -->
        
        <!-- Settings Tabs -->
        <nav class="nav nav-tabs" aria-label="Secondary menu">
            <a href="#tab-1" class="tab active" title="All Custom Post Types">All</a>
            <a href="#tab-2" class="tab" title="Add Custom Post Type">Add</a>
            <a href="#tab-3" class="tab" title="Export Custom Post Types">Export</a>
        </nav>
        <!-- /Settings Tabs -->
    </div>
    <!-- /Screen Header Section -->

    <!-- Tab Content -->
    <div class="tab-content">
        <?php
            // Settings Feedback
            settings_errors();
        ?>
        
        <!-- First Tab -->
        <div id="tab-1" class="tab-pane active">
            <h3>Manage Custom Post Types</h3>
            <?php
                $option = 'lbd-custom-post-type';

                if ( get_option( $option ) ):
                    $options = get_option( $option );
                    
                    if ( ! empty( $options ) ):
                    ?>
                    <div class="table-container">
                        <div class="table-header">
                            <ul class="row">
                                <li class="item">ID</li>
                                <li class="item">Singular Name</li>
                                <li class="item">Plural Name</li>
                                <li class="item">Public</li>
                                <li class="item">Archive</li>
                            </ul>
                        </div>
                        <div class="table-body">
                            <?php
                            foreach ( $options as $cpt => $props ):
                            ?>
                            <ul id="<?php echo 'post-type-' . $cpt; ?>" class="row">
                                <li class="item"><?php echo $props['post-type-id']; ?></li>
                                <li class="item"><?php echo $props['singular-name']; ?></li>
                                <li class="item"><?php echo $props['plural-name']; ?></li>
                                <li class="item"><?php echo $props['public'] ? 'Yes' : 'No'; ?></li>
                                <li class="item"><?php echo $props['has-archive'] ? 'Yes' : 'No'; ?></li>
                            </ul>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php else: ?>
                        <p><em>No custom post types</em></p>
                    <?php
                    endif;
                endif;
            ?>
        </div>
        <!-- /First Tab -->
        
        <!-- Second Tab -->
        <div id="tab-2" class="tab-pane">
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
        <!-- /Second Tab -->
        
        <!-- Third Tab -->
        <div id="tab-3" class="tab-pane">
            <h3>Export Custom Post Types</h3>
            <p><em>Coming Soon!</em></p>
        </div>
        <!-- /Third Tab -->
    </div>
    <!-- /Tab Content -->
</div>