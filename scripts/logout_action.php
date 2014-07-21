<?php 
ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

po_user_logout_action('username', '../dashboard.php') ?>