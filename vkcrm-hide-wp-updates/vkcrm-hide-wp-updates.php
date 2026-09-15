<?php
/**
 * Plugin Name: Hide WP Updates: Приховати оновлення
 * Plugin URI: https://github.com/devapromix/hide-wp-updates
 * Description: Приховує повідомлення та індикатори про оновлення WordPress, плагінів, тем і перекладів до нової версії та вимикає автоматичні оновлення.
 * Version: 1.0.0
 * Author: APROMIX
 * Author URI: https://github.com/devapromix
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


// Приховуємо повідомлення WordPress про рекомендоване оновлення PHP.
add_action( 'wp_dashboard_setup', function() {
    remove_meta_box( 'dashboard_php_nag', 'dashboard', 'normal' );
} );

// Додатково приховуємо PHP update notice в адмінці.
add_action( 'admin_head', function() {
    echo '<style>
        .notice.php-update-nag,
        .php-update-nag,
        #dashboard_php_nag {
            display: none !important;
        }
    </style>';
}, 999 );
