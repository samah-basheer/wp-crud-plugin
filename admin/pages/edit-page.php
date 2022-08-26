<?php

function edit_page() {
    if(isset($_GET['subscriber'])) {
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
            <input type="hidden" name="form-name" value="edit-subscriber">
            <?php
            submit_button('Add Subscriber');
            ?>
        </form>
    </div>
    <?php
    }
}