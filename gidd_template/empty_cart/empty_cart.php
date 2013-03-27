<?php

session_start();
$_SESSION['order'] = "";
$_SESSION['order_addon'] = "";
$_SESSION['total'] = "";
$_SESSION['morder'] = "";
$_SESSION['mtotal'] = "";
$_SESSION['numItem'] = "";
$_SESSION['restoo'] = "";
$_SESSION['sms'] = "";
$_SESSION['terminal'] = "";
$_SESSION['invoice_confirm'] = "";
$_SESSION['IMG_GEN'] = "";

wp_redirect( site_url('/restaurant/') );
exit;

/** empty_cart.php */