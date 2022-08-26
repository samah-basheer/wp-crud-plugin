<?php

function edit_page() {
    if(isset($_GET['subscriber'])) {
        global $wpdb;
        $table_crud = $wpdb->prefix . 'crud';

        $id = $_GET['subscriber'];
        $sql = $wpdb->prepare("SELECT * FROM $table_crud WHERE id = %s", $id);
        $result = $wpdb->get_row($sql);

        $name = $result->name;
        $email = $result->email;
        $date = $result->date;

        $d = explode(" ", $date);
        $dt = $d[0];
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="POST" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
            <table class="form-table" role="presentation">
                <tbody>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="">
                            Username
                            <span class="description">(required)</span>
                        </label>
                    </th>
                    <td>
                        <input name="name" type="text" id="" value="<?php echo $name;?>" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="">
                            Email
                            <span class="description">(required)</span>
                        </label>
                    </th>
                    <td>
                        <input name="email" type="text" id="" value="<?php echo $email;?>" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="">
                            Date
                            <span class="description">(required)</span>
                        </label>
                    </th>
                    <td>
                        <input name="date" type="date" id="" value="<?php echo $dt;?>" aria-required="true">
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="hidden" name="redirect_crud_post" value="<?php echo esc_html( admin_url( 'admin.php?page=edit-subscriber&action=edit&subscriber='.$id ) ); ?>">
            <input type="hidden" name="form-name" value="edit_subscriber">
            <input type="hidden" name="subscriber-id" value="<?php echo $id;?>">
            <?php
            submit_button();
            ?>
        </form>
    </div>
    <?php
    }
}

function subscriber_update_entry(){
    if( $_POST["form-name"] == 'edit_subscriber' ) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $id = $_POST['subscriber-id'];
        if ( ! empty( $name ) && ! empty( $email ) && ! empty( $date ) ) {

            global $wpdb;
            $table_crud = $wpdb->prefix . 'crud';

            $sql = $wpdb->prepare("UPDATE $table_crud SET name=%s, email=%s, date=%s WHERE id=$id", $name, $email, $date);
            $insert_data = $wpdb->query($sql);

            if ( ! $insert_data ) {
                die( 'Not able to edit subscriber' );
            }
        }
        crud_admin_post_redirect();
    }
}
add_action( 'admin_post', 'subscriber_update_entry' );