<?php

function crud_admin_menu() {

    add_menu_page('CRUD Action','CRUD Action', 'activate_plugins', 'crud', 'crud_page', 'dashicons-admin-generic', 63 );

    add_submenu_page(
        'crud',
        'Subscribers',
        'All Subscribers',
        'edit_pages',
        'crud',
        'crud_page'
    );
    add_submenu_page(
        'crud',
        'Add New Subscriber',
        'Add New',
        'edit_pages',
        'subscriber_new',
        'add_page'
    );
    add_submenu_page(
        'null',
        'Edit Subscriber',
        'null',
        'edit_pages',
        'edit-subscriber',
        'edit_page'
    );
    // add_options_page puts a menu/link in the “Settings” menu
    // add_menu_page puts a menu/link at the same level as “Dashboard”, “Posts”, “Media”, etc.
    // add_submenu_page puts a menu/link as a child underneath “Dashboard”, “Posts”, “Media”, etc.
}
add_action('admin_menu', 'crud_admin_menu');