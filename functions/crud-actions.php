<?php
function delete_subscriber() {
    global $wpdb;
    $table_crud = $wpdb->prefix . 'crud';

    $id = $_POST['id'];
    $wpdb->delete( $table_crud, array( 'id' => $id ) );

    wp_send_json_success($id);
}
add_action( 'wp_ajax_delete_subscriber', 'delete_subscriber' );