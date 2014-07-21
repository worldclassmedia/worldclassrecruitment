<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$name = mysql_real_escape_string($_POST["name"]);

//Query
$insert_query = mysql_query("INSERT INTO categories (cat_id,category_name)
	VALUES('NULL','$name')
	", $db_connect);
if(!$insert_query){
	die("Cannot insert the category into the database, the server said: ".mysql_error());
	}
	
if(!$insert_query){
	die("Cannot run query to insert testimonials: ".mysql_error());
	} else {
		header("location: ../addcategory.php");
		}
?>