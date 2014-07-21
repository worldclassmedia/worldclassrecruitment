<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$job_title = mysql_real_escape_string($_POST["job_title"]);
$description = mysql_real_escape_string($_POST["description"]);
$person_spec = mysql_real_escape_string($_POST["person_spec"]);
$category_id = mysql_real_escape_string($_POST["category_id"]);
$location_id = mysql_real_escape_string($_POST["location_id"]);
$salary = mysql_real_escape_string($_POST["salary"]);
//Reformating Salary
$salary = clean_salary($salary);
//Test
//echo $job_title . $salary . $location . $description . $person_spec;

$add_job_query = mysql_query("INSERT INTO jobs (job_id, job_title, salary, job_description, cat_id, location_id, specification,status)
VALUE (NULL,'$job_title','$salary','$description','$category_id','$location_id','$person_spec', 'draft')");

if(!$add_job_query){
	die ("Could not insert the value's into database. The server said: ".mysql_error());
}

else {
	$id_query = mysql_query("SELECT * FROM jobs ORDER BY job_id DESC LIMIT 1");
	while ($row = mysql_fetch_array($id_query)){
		$id = $row["job_id"];
	}
	
	header ("location: ../addjob.php?step=2&id=$id#screening_questions_content");
}
?>