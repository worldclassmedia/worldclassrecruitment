<?php
$ref = po_current_page_url();
po_user_login_gateway("username", "login.php?status=failed&ref={$ref}");
?>
