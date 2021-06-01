<?php

use Woof\ListTable\PostListTable;

if (! class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}



$myListTable = new PostListTable('woof-schema');


$myListTable->setEditURLCallBack(function($item) {
    return sprintf('<a href="?page=woof-schema-builder--builder&post=%s">Edit</a>', $item['id']);
});

/*
$myListTable->setDeleteURLCallBack(function($item) {
    return sprintf('<a href="?page=woof-schema-builder--delete&post=%s">Delete</a>', $item['id']);
});
*/




$myListTable->prepareItems();
$myListTable->display();