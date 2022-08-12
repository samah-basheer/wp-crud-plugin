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
            $results = $wpdb->get_results("SELECT * FROM $table_crud WHERE email Like '%{$_GET['s']}%' OR name Like '%{$_GET['s']}%' OR date Like '%{$_GET['s']}%'");
        } else {
            $results = $wpdb->get_results("SELECT * FROM $table_crud");
        }
        $data = array();
        foreach ( $results as $item ) {
            $row['email'] = $item->email;
            $row['name'] = $item->name;
            $row['date'] = $item->date;
//            $row['action'] = '<input type="button" class="button-secondary" style="border-color: #dc3545; color: #dc3545;" onclick="removeSubscriber(' . $item->id .')" value="Remove">';
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
}