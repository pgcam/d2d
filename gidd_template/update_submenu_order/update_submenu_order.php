<?php

$order = $_POST['submenu_order'];
$rid = $_POST['rid'];

update_post_meta($rid, 'submenu_order', $order );
wp_redirect( site_url('/sort_submenu/') );
exit;








/** end of update_submenu_order.php */