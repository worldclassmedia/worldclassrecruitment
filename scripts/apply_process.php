<?php ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');

//Form Variables
$screening_answer = $_POST["screening_answer"];
$job_id = $_GET["job_id"];
$cv_id = $_GET["cv_id"];

//Insert into Applied Jobs
	$applied_job_query = mysql_query("INSERT INTO applied_jobs 
	(job_id, cv_id, status)
	VALUE
	('$job_id', '$cv_id', 'applied')
	");
	if(!$applied_job_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 01");
		} 
		
//Get ID for applied Jobs
	$application_id_query = mysql_query("SELECT * FROM applied_jobs ORDER BY application_id DESC LIMIT 1");
	if(!$application_id_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 02");
		} 
		//else {echo "step 2 worked.";}
		
	while ($row = mysql_fetch_array($application_id_query)){
		$application_id = $row["application_id"];
		}
		
//Insert into Screening Answers.
foreach ($screening_answer as $question_id => $screening_answer){

	$add_answer_query = mysql_query("INSERT INTO screening_answers
	(job_id, application_id, question_id, answer)
	VALUE
	('$job_id','$application_id','$question_id','$screening_answer')
	");
	
	//If any of the queries fail, won't get out of loop
	if(!$add_answer_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 03");
		}
}

//Send Emails
	//Get job information.
	$get_job_query = mysql_query("SELECT * FROM jobs WHERE job_id = '$job_id'");
	if(!$get_job_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 04");
		}
	while ($job_row = mysql_fetch_array($get_job_query)){
		$job_title = $job_row["job_title"];
		}

	//Get applicant information.
	$get_email_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id = '$cv_id'");
	if(!$get_email_query){
		die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 04");
		}
	while ($email_row = mysql_fetch_array($get_email_query)){
		$applicant_email = $email_row["applicant_email"];
		$applicant_name = $email_row["applicant_name"];
		}
	
	//Email admin
		$admin_email = "info@worldclassrecruitment.co.uk";
		$admin_subject = "A new application from: ".ucfirst($applicant_name);
		$admin_headers = 'From: '. "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
					'Reply-To:' . "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		
		$admin_message = "A new application has been processed on the World Class Recruitment website. \r\n Please click here to view the application: ".global_website_url."view_applied_job.php?id=".$job_id."&app_id=".$application_id."";
		
		//Check if email is successfully sent
		if(!mail ($admin_email, $admin_subject, $admin_message, $admin_headers)){
			die("Well this is embarasing! There's been a problem. The server said: email unable to send. -Error 05");
			}
			
	//Email Applicant
		$applicant_subject = "Thank you for applying for the role: ".$job_title;
		$applicant_headers = 'From: '. "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
					'Reply-To:' . "no-reply@worldclassrecruitment.co.uk" . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		
$applicant_message = "Hello ".$applicant_name.", \r\n
Thank you for applying for the role of ".ucwords($job_title)." via the World Class Recruitment website.\r\n
We are now reviewing your application and will be in touch soon, whether you are successful this time or not.\r\n
Your Application ID is: ".$application_id." (Please keep this for reference)\r\n
In the meantime, why not check out the other positions we are currently recruiting for? You can apply for as many World Class careers as you like!\r\n
We look forward to speaking to you again soon!
Warmly,\r\n
World Class Recruitment";
		
		//Check if email is successfully sent
		if(!mail ($applicant_email, $applicant_subject, $applicant_message, $applicant_headers)){
			die("Well this is embarasing! There's been a problem. The server said: email unable to send. -Error 06");
			}

//If managed to successfully get out of loop, check again. Then redirect.
if(!$add_answer_query){
	die("Well this is embarasing! There's been a problem. The server said: ".mysql_error()." -Error 07");
	} else {
		header("location:../applied_job_success.php?cv_id=$cv_id&id=$application_id&job_id=$job_id");
		}
?>