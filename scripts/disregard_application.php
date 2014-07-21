<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Variables
$id = mysql_real_escape_string($_GET["id"]);

$update_query = mysql_query("UPDATE applied_jobs
				 SET status = 'disregarded'
				  WHERE application_id = '$id'");
					  
	if(!$update_query){
		die("Could not update the database. Something went wrong! The server said: ".mysql_error());
	} else {
		header("location: ../applied_jobs.php?status=disregarded_job");
		}

?>