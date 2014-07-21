<?php session_start();
/*
=========================================
Pushover Library
Version: 1.0
Author: Jason King, Pushover Online
Licence: www.pushoveronline.co.uk/licence
© Copyright www.pushoveronline.co.uk
=========================================
*/

/*
WARNING: Editing anything in this file may break the Pushover Library, it's recommended you only edit the options file called "pushover_settings.php".
================================================================================
*/

//=======User settings and includes=======//
require('pushover_settings.php');
require('pushover_user_includes.php');

//=======No Direct Access=======//
if(!defined("DIRPATH") && $_POST["po_direct_email_script"] !=="yes"){
	die("Hmmmm, I don't think you're allowed to access this file.");
	}

//=======Establishing Database Connection=======//
$db_connect = mysql_connect(db_connection, db_username, db_password);
if(!$db_connect) {
	die("Whoops the database connection could not be established: ".$db_connect);
	}
	
	$db_select = mysql_select_db (db_name, $db_connect);
	if(!$db_select) {
		die ("Could not select table in database: ".mysql_error());
		}

/*
==========================
======Start Functions=====
==========================
*/


//=======User Log In Script=======//
function po_user_login_action($username, $password, $success_location, $failure_location, $table, $table_user, $table_password, $MySQL_error_message, $assigned_session) {
	
	global $db_connect;
	
	if(empty($MySQL_error_message)){
		$MySQL_error_message = po_mysql_error_message;
	}
	
	//Strip out any slashes
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	//Get ready to work in the query
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	//Secure password
	$secure_salt = "P!£%&()O@$^*)@&)@!((@P!£%&()O@$^*)@&)@!((@";
	$password  = sha1($secure_salt . $password);
	
	//Get results, and check with database
	$results = mysql_query ("SELECT *
							FROM {$table}
							WHERE $table_user = '{$username}'
							AND $table_password = '{$password}'", $db_connect);	
											
	//Display database error				
	if(!$results){
		die("{$MySQL_error_message}" . " " . mysql_error());
		}
		
	//Checking both username and password are on one row.
	$count = mysql_num_rows($results);
	
	//Assign to sessions
	if ($count == 1){
		session_start();
		$_SESSION[$assigned_session] = $username;
		header("location:{$success_location}");
		}
		
	else {
		header("location:{$failure_location}");
		}
	}

//=======User Log In Gateway=======//
function po_user_login_gateway($assigned_session, $failure_location) {
	session_start(); 
	if (!isset($_SESSION[$assigned_session])) {
		header ("location:{$failure_location}");
		}
}

//=======User Log Out Script=======//
function po_user_logout_action($assigned_session, $logout_location) {
	session_start();
	if(isset($_SESSION[$assigned_session])){
		unset($_SESSION[$assigned_session]);
	}
	header ("location:{$logout_location}");
	}

//=======Send Mail Script=======//
function po_form_email($form_data, $email, $subject, $reply_email, $success_url, $error_url, $email_top, $email_bottom){
	
	$headers = 'From: '. $reply_email . "\r\n" .
				'Reply-To:' . $reply_email . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
	//Initalize Message Variable
	$message = ""; 
	
	//The Email:
		//Top of email text
		$message .= $email_top;
		$message .= "\r\n";
		$message .= "\r\n";
		
		//The form going into email
		foreach($form_data as $form_header => $form_data){
			
			//Asigning the message fields to $message variable.
			$message .= $form_header.": ".$form_data;
			
			//The spaces inbetweeen
			$message .= "\r\n";
		}
		
		//Bottom of the email
		$message .= "\r\n";
		$message .= "\r\n";
		$message .= $email_bottom;
	
	//Check if email is successfully sent
	if(mail ($email, $subject, $message, $headers)){
		header("location: {$success_url}");
		} else {
			if(isset($_POST["error_url"])){//user set error message
				header("location: {$error_url}");
			} else { //Default error message
				echo "The message was not sent. An error has occured. Please try again later.";}
			}
}

function po_quick_email($to, $subject, $message, $from, $reply, $success_value){
$headers = 'From: '. "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
			'Reply-To:' . "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

//Check if email is successfully sent
if(mail ($to, $subject, $message, $headers)){
	return ($success_value);
	}
}

//=======Variable Testing=======//
function po_var_test(){
session_start();
echo "
Variable Testing:
<br /><p></p><br />
All assigned 'SESSION' variables: <br />";
var_dump($_SESSION);

echo
"<br /><p></p><br />
All assigned 'COOKIE' variables: <br />";
var_dump($_COOKIE);

echo "
<br /><p></p><br />
All assigned 'POST' variables: <br />";
var_dump($_POST);

echo
"<br /><p></p><br />
All assigned 'GET' variables: <br />";
var_dump($_GET);
	}



//=======Current URL=======//
function po_current_page_url() {
	$currentURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$currentURL .= "s";}
	$currentURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$currentURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$currentURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $currentURL;
}


function po_current_page_name() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

//=======Delete from database=======//
function po_delete_from_database($table, $delete_where, $delete_value, $success_value){
	global $db_connect;
	
	$po_delete_query = "DELETE FROM {$table} WHERE {$delete_where} = '{$delete_value}'";
				  
	if(!mysql_query($po_delete_query,$db_connect)){
		die(po_mysql_error_message);
		}
	else {
		return $success_value;
		}
}

//=======Update database entry=======//
function po_update_database_entry($table, $set_where, $set_value, $update_where, $is_equal_to, $success_value){
	global $db_connect;
	
	$po_update_query = "UPDATE {$table} SET {$set_where} = '{$set_value}' WHERE {$update_where} = '$is_equal_to'";

	if(!mysql_query($po_update_query,$db_connect)){
		die(po_mysql_error_message);
		}
	else {
		return $success_value;
		}
}

/*
==========================
===Start Direct Scripts===
==========================
*/

//=======Send Direct Mail Script=======//
if($_POST["po_direct_email_script"] == "yes"){ //Check if information coming into script is allowed to be used.
	//Grabbing Settings
	$success_url = $_POST["success_url"];
	$error_url = $_POST["error_url"];
	$reply_email = $_POST["reply_email"];
	
	//Grabbing hidden field data.
	$email = $_POST["email_address"];
	$subject = $_POST["email_subject"];
	$headers = 'From: '. $reply_email . "\r\n" .
				'Reply-To:' . $reply_email . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
	//Initalize Message Variable
	$message = ""; 
	
	//The Email:
		//Top of email text
		$message .= $_POST["email_top"];
		$message .= "\r\n";
		$message .= "\r\n";
		
		$form_data = $_POST['form_data'];
		
		//The form going into email
		foreach($form_data as $form_header => $form_data){
			
			//Asigning the message fields to $message variable.
			$message .= $form_header.": ".$form_data;
			
			//The spaces inbetweeen
			$message .= "\r\n";
		}
		
		//Bottom of the email
		$message .= "\r\n";
		$message .= "\r\n";
		$message .= $_POST["email_bottom"];
	
	//Check if email is successfully sent
	if(mail ($email, $subject, $message, $headers)){
		header("location: {$success_url}");
		} else {
			if(isset($_POST["error_url"])){//user set error message
				header("location: {$error_url}");
			} else { //Default error message
				echo "The message was not sent. An error has occured. Please try again later.";}
			}
}
?>