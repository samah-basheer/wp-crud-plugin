<?php

/**
 * Class for displaying Subscribers Entries
 */
class Crud_List_Table extends WP_List_Table {
    // table columns
    public function get_columns() {
        $table_columns = array(
            'name' => 'Name',
            'email' => 'Email',
            'date' => 'Date'
        );
        return $table_columns;
    }
    // display if there is no rows
    public function no_items() {
        echo 'No subscribers found.';
    }
    // sort columns
    public function get_sortable_columns() {
        return $sortable = array(
            'name'=>array('name',true),
            'email'=>array('email',false),
            'date'=>array('date',false),
        );
    }

    // prepare rows
    public function prepare_items() {

        global $wpdb;
        $per_page = 20;

        $table_crud = $wpdb->prefix . 'crud';

        if (isset($_GET['page']) && isset($_GET['s']) && $_GET['page'] == 'crud') {
            $search = "%" . $_GET['s'] . "%";
            $sql = $wpdb->prepare("SELECT * FROM $table_crud WHERE email Like %s OR name Like %s OR date Like %s", $search, $search, $search);
            $results = $wpdb->get_results($sql);
        } else {
            $results = $wpdb->get_results("SELECT * FROM $table_crud");
        }
        $data = array();
        foreach ( $results as $item ) {
            $row['id'] = $item->id;
            $row['email'] = $item->email;
            $row['name'] = $item->name;
            $row['date'] = $item->date;
            $data[] = $row;
        }
        $current_page = $this->get_pagenum();
        $total_items = count( $data );
        $data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );
        $this->items = $data;

        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        function usort_reorder($a, $b)
        {
            // If no sort, default to date
            $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'date';

            // If no order, default to desc
            $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';

            // Determine sort order
            $result = strcmp($a[$orderby], $b[$orderby]);

            // Send final sort direction to usort
            return ($order === 'asc') ? $result : -$result;
        }

        usort($this->items, 'usort_reorder');

        // pagination
        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page ),
        ) );
    }

    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            default:
                return $item[$column_name];
        }
    }
    function column_name($item) {
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&subscriber=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            'delete'    => sprintf('<a href="#" onclick="delete_subscriber(%s)">Delete</a>',$item['id']),
        );

        return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions) );
    }
}