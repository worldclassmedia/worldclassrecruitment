<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$job_title = mysql_real_escape_string($_POST["job_title"]);
$salary = mysql_real_escape_string($_POST["salary"]);
$description = mysql_real_escape_string($_POST["description"]);
$person_spec = mysql_real_escape_string($_POST["person_spec"]);
$job_id = $_GET["id"];
$question = mysql_real_escape_string($_POST["question"]);
$prefered_answer = $_POST["prefered_answer"];
$category_id = $_POST["category_id"];
$location_id = mysql_real_escape_string($_POST["location_id"]);


$update_query = mysql_query("UPDATE jobs
				 SET job_title = '$job_title',
					  salary = '$salary',
					  job_description = '$description',
					  specification = '$person_spec',
					  cat_id = '$category_id',
					  location_id = '$location_id',
					  status = 'posted'
				  WHERE job_id = '$job_id'");
					  
	if(!$update_query){
		die("Could not update the database. Something went wrong! The server said: ".mysql_error());
	}

if(isset($_POST["add_question"])){
	$add_question_query = mysql_query("INSERT INTO screening_questions (job_id, question, prefered_answer)
	VALUE ('$job_id', '$question', '$prefered_answer')");
	
	if(!$add_question_query){
		die("Could not add question into database, the server said: ".mysql_error());
	}
}
	

if(isset($_POST["update_job"])){
		header("location: ../editjob.php?id=$job_id&status=updated_question");
	}
	
elseif(isset($_POST["add_question"])){
		header("location: ../editjob.php?id=$job_id&status=added_question#screening_questions_content");
}
?>