<?php

use Woof\ListTable\PostListTable;

if (! class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}






$myListTable = new PostListTable('woof-schema');
$myListTable->prepare_items();
$myListTable->display();