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

<div class="wrap">
    <h1>LBD Plugin Dashboard</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
            settings_fields( 'lbd_options_group' );
            do_settings_sections( 'lbd-plugin' );
            submit_button();
        ?>
    </form>
</div>