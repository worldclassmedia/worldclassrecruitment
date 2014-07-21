<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$name = mysql_real_escape_string($_POST["name"]);
$date = mysql_real_escape_string($_POST["date"]);
$quote = mysql_real_escape_string($_POST["quote"]);

//Query
$insert_query = mysql_query("INSERT INTO testimonials (test_id,name,date,message)
	VALUES('NULL','$name','$date','$quote')
	", $db_connect);
	
if(!$insert_query){
	die("Cannot run query to insert testimonials: ".mysql_error());
	} else {
		header("location: ../addtestimonial.php");
		}
?>