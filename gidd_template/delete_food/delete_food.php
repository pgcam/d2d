<?php

$id = $_GET['id'];
$rid = $_GET['rid'];

//true = bypass trash
wp_delete_post( $id, true );

wp_redirect( site_url( '/edit_menu?id=' . $rid ) );
exit;

/** end of delete_food.php */