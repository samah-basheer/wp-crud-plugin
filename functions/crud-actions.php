<?php
function delete_subscriber() {
    global $wpdb;
    $table_crud = $wpdb->prefix . 'crud';

    $id = $_POST['id'];
    $wpdb->delete( $table_crud, array( 'id' => $id ) );

    wp_send_json_success($id);
}
add_action( 'wp_ajax_delete_subscriber', 'delete_subscriber' );

function crud_admin_post_redirect() {

    if ( ! isset( $_POST['redirect_crud_post'] ) ) {
        $_POST['redirect_crud_post'] = wp_login_url();
    }

    $url = sanitize_text_field( wp_unslash( $_POST['redirect_crud_post'] ) );
    wp_safe_redirect( urldecode( $url ) );
    exit;
}