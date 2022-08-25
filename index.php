<?php
/**
 * Plugin Name: CRUD Plugin
 * Description: A plugin for crud action
 * Version: 1.0.0
 * Author: Samah Basheer
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function codechief_settings_page($links) {
    $links[] = '<a href="'.admin_url('/admin.php?page=crud').'">' . __( 'Settings', 'domain' ) . '</a>';
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'codechief_settings_page');

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * enqueue Admin js file
 */
function crud_admin_enqueue_scripts() {
//    wp_enqueue_style( 'subscribe-css', plugin_dir_url( __FILE__ ) . 'assets/css/main.css', array(), time() );
    wp_enqueue_script( 'subscriber-js', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'crud_admin_enqueue_scripts' );

include dirname( __FILE__) . '/admin/menu.php';
include dirname( __FILE__) . '/admin/pages/crud-page.php';
include dirname( __FILE__) . '/admin/pages/add-new.php';
include dirname( __FILE__) . '/functions/crud-db.php';
include dirname( __FILE__) . '/admin/class/crud-class-list.php';
include dirname( __FILE__) . '/functions/crud-actions.php';