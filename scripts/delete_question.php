<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$question_id = $_GET["id"];
$job_id = $_GET["job_id"];
$return_url = $_GET["return_url"];

$delete_query = mysql_query("DELETE FROM screening_questions WHERE question_id = '$question_id'");
				  
if(!$delete_query){
	die("Could not delete from the database. Something went wrong! The server said: ".mysql_error());
	}
else {
	if($return_url === "add_job")
		header("location: ../addjob.php?step=2&id=$job_id&status=deleted_question#screening_questions_content");
	elseif($return_url === "update_job") {
		header("location: ../editjob.php?id=$job_id&status=deleted_question#screening_questions_content");
		}
	}
?>