<?php
function add_page() {
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
                            <input name="name" type="text" id="" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
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
                            <input name="email" type="text" id="" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
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
                            <input name="date" type="date" id="" value="" aria-required="true">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="redirect_crud_post" value="<?php echo esc_html( admin_url( 'admin.php?page=crud' ) ); ?>">
            <input type="hidden" name="form-name" value="add_subscriber">
            <?php
            submit_button('Add Subscriber');
            ?>
        </form>
    </div>
    <?php
}

function subscriber_save_entry(){
    if( $_POST["form-name"] == 'add_subscriber' ) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        if ( ! empty( $name ) && ! empty( $email ) && ! empty( $date ) ) {

            global $wpdb;
            $table_crud = $wpdb->prefix . 'crud';

            $insert_data = $wpdb->insert(
                $table_crud,
                array('name'     => $name,
                    'email' => $email,
                    'date'   => $date.date(' H:i:s')
                )
            );

            if ( ! $insert_data ) {
                die( 'Not able to add new subscriber' );
            }
        }
        crud_admin_post_redirect();
    }
}
add_action( 'admin_post', 'subscriber_save_entry' );