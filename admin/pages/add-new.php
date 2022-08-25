<?php
function add_page() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="" name="" id="">
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
                            <input name="" type="text" id="" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
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
                            <input name="" type="text" id="" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
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
                            <input name="" type="date" id="" value="" aria-required="true">
                        </td>
                    </tr>
                </tbody>
            </table>


            <p class="submit">
                <input type="submit" name="" id="" class="button button-primary" value="Add New Subscriber">
            </p>
        </form>
    </div>
    <?php
}