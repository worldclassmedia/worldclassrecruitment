<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$id = $_GET["id"];

//Query
$delete_query = mysql_query("DELETE FROM testimonials WHERE test_id = $id", $db_connect);
	
if(!$delete_query){
	die("Cannot run query to insert testimonials: ".mysql_error());
	} else {
		header("location: ../addtestimonial.php?status=delete");
		}
?>