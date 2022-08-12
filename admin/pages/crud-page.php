<?php
function crud_page() {
    $subscriber_table = new Crud_List_Table();
    $subscriber_table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form id="" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
            <?php $subscriber_table->search_box('Search', 'search') ?>
            <?php $subscriber_table->display(); ?>
        </form>
    </div>
    <?php
}