<?php
function crude_db_after_setup_theme() {
    // change the version to update db structure
    $crud_db_version = "1.0";
    if ($crud_db_version != get_option("crud_db_version")) {
        global $wpdb;

        $crud_table = $wpdb->prefix . 'crud';
        $sql = "CREATE TABLE $crud_table (
			`id` INTEGER (10) NOT NULL AUTO_INCREMENT,
			`date` DATETIME NOT NULL,
			email VARCHAR(50) NOT NULL UNIQUE,
			name VARCHAR(50) NOT NULL,
			PRIMARY KEY (`id`))";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta( $sql );

        update_option( 'crud_db_version', $crud_db_version );
    }
}
add_action('after_setup_theme', 'crude_db_after_setup_theme');