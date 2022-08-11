<?php

function crud_admin_menu() {

    add_menu_page('CRUD Action','CRUD Action', 'activate_plugins', 'crud', 'crud_page', 'dashicons-admin-users', 63 );

    add_submenu_page(
        'crud',
        'CRUD Action',
        'CRUD Action',
        'edit_pages',
        'crud',
        'crud_page'
    );
    // add_options_page puts a menu/link in the “Settings” menu
    // add_menu_page puts a menu/link at the same level as “Dashboard”, “Posts”, “Media”, etc.
    // add_submenu_page puts a menu/link as a child underneath “Dashboard”, “Posts”, “Media”, etc.
}
add_action('admin_menu', 'crud_admin_menu');