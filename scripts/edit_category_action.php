<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$name = mysql_real_escape_string($_POST["name"]);
$id = mysql_real_escape_string($_GET["id"]);

//Query
$insert_query = mysql_query("UPDATE categories 
							  SET category_name = '$name'
								  WHERE cat_id = $id
								  ", $db_connect);
	
if(!$insert_query){
	die("Cannot run query to insert categories: ".mysql_error());
	} else {
		header("location: ../addcategory.php?status=updated");
		}
?>