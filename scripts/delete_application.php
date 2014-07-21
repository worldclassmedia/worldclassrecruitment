<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Variables
$application_id = $_GET["application_id"];
$cv_id = $_GET["cv_id"];
$job_id = $_GET["job_id"];

//Get job information.
	$get_job_query = mysql_query("SELECT * FROM jobs WHERE job_id = '$job_id'",$db_connect);
	if(!$get_job_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 04");
		}
	while ($job_row = mysql_fetch_array($get_job_query)){
		$job_title = $job_row["job_title"];
		}

	//Get applicant information.
	$get_email_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id = '$cv_id'",$db_connect);
	if(!$get_email_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 04");
		}
	while ($email_row = mysql_fetch_array($get_email_query)){
		$applicant_email = $email_row["applicant_email"];
		$applicant_name = $email_row["applicant_name"];
		}

//Updating table and sending the email.
if(po_update_database_entry('applied_jobs','status','deleted','application_id',$application_id, TRUE) == TRUE){
	if(po_quick_email(
		$applicant_email, 
		"World Class Recruitment job update",
		
//Start Success Email
"Hello ".$applicant_name.", Thank you for applying for the position of ".ucwords($job_title)."\r\n
Although your CV was impressive, unfortunately you have not been successful with your application this time. This may be due to the fact the role has already been filled or if your previous experience doesn’t quite match up to this particular position.\r\n
However, why don’t you take a look at our other advertised jobs? You may have been unsuccessful for this role, but you could be perfect for another!\r\n
Warmly,\r\n
World Class Recruitment", 

		"no-reply@WorldClassRecruitment.co.uk", 
		"no-reply@WorldClassRecruitment.co.uk", 
		TRUE) == TRUE){
			header("location: ../applied_jobs.php?view=view_disregards&status=deleted");
			} else {
				echo "There's been an error sending an email to the applicant. Please show this error to Jason. Error 01";
				}
	}
?>