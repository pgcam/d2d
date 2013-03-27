<?php

$post_id = $_POST['pid'] ;
echo get_post_meta( $post_id, 'wing_status', true  );

exit;
/*** get_invoice_status.php **/