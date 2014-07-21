<?php 
ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

if(isset($_GET["ref"])){
	$redirect_url = $_GET["ref"];
} else {
	$redirect_url = "../dashboard.php?status=success";
	}

po_user_login_action($_POST["username"], $_POST["password"], $redirect_url, '../login.php?status=failed', 'users', 'username', 'password', "Whoops, cannot run query. The server said: ", 'username'); ?>