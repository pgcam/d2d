<?php

session_start();
$_SESSION['order'] = "";
$_SESSION['order_addon'] = "";
$_SESSION['total'] = "";
$_SESSION['morder'] = "";
$_SESSION['mtotal'] = "";
$_SESSION['numItem'] = "";
$_SESSION['restoo'] = "";

wp_redirect( site_url('/restaurant/') );
exit;

/** empty_cart.php */