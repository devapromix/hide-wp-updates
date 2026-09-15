<?php
/**
 * Plugin Name: HideWPUpd: Прихувати оновлення
 * Plugin URI: http://wordpress.org/plugins/hello-dolly/
 * Description: Приховує повідомлення та індикатори про оновлення WordPress, плагінів, тем і перекладів до нової версії та вимикає автоматичні оновлення.
 * Version: 1.0.0
 * Author: APROMIX
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'pre_site_transient_update_core', '__return_null' );
add_filter( 'pre_site_transient_update_plugins', '__return_null' );
add_filter( 'pre_site_transient_update_themes', '__return_null' );
add_filter( 'pre_site_transient_translation_updates', '__return_null' );

add_filter( 'automatic_updater_disabled', '__return_true' );
add_filter( 'auto_update_core', '__return_false' );

add_action( 'admin_menu', function() {
    remove_submenu_page( 'index.php', 'update-core.php' );
}, 999 );

add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'updates' );
}, 999 );

add_action( 'admin_head', function() {
    echo '<style>
        #wp-admin-bar-updates,
        .update-nag,
        .update-message,
        .update-plugins,
        .update-themes {
            display: none !important;
        }
    </style>';
}, 999 );
