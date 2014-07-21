<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$name = mysql_real_escape_string($_POST["name"]);
$date = mysql_real_escape_string($_POST["date"]);
$quote = mysql_real_escape_string($_POST["quote"]);
$id = mysql_real_escape_string($_GET["id"]);

//Query
$insert_query = mysql_query("UPDATE testimonials 
							  SET name = '$name',
							  	  date = '$date',
								  message = '$quote'
								  WHERE test_id = $id
								  ", $db_connect);
	
if(!$insert_query){
	die("Cannot run query to insert testimonials: ".mysql_error());
	} else {
		header("location: ../addtestimonial.php?status=updated");
		}
?>