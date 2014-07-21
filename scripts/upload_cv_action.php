<?php ob_start(); ?>
<html>
<body>
<div style="margin-right:auto;margin-left:auto;margin-top:50px;width:218px;text-align:center;color:rgba(117,117,117,1.00);">
Uploading your file. <br />Please be patient.
</div>
<div style="margin-right:auto;margin-left:auto;margin-top:10px;width:218px;">
<img src="../img/ajax-loader.gif" alt=""/>
</div>

<?php
define("DIRPATH", TRUE);
require('../pushover_library.php');

$job_id = $_GET["id"];
$applicant_email = mysql_real_escape_string($_POST["upload_cv_email"]); 
$applicant_name = mysql_real_escape_string($_POST["upload_cv_name"]);

//Allowed file type parameters
$allowedExts = array(
	"pdf", 
	"doc",
	"txt",
	"docx"
); 

$allowedMimeTypes = array( 
	'application/msword',
	'text/pdf',
	'text/plain',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
);

$extension = end(explode(".", $_FILES["files_upload"]["name"]));

//Check file size
if ( 10485760 < $_FILES["file"]["size"]  ) {
	header("location: upload_cv.php?id=$job_id&status=too_large");
	die("Error (File 01)");
}

//Checking file type (Extension)
if ( ! ( in_array($extension, $allowedExts ) ) ) {
	header("location: upload_cv.php?id=$job_id&status=wrong_type");
	die("Error (Extension 02)");
}

//Asking if allowed (Mine Types)
if ( in_array( $_FILES["files_upload"]["type"], $allowedMimeTypes ) ) { 
    
	//Start upload proccess. 
	start_again:
	
	$random_number = rand(10000,99999); // random number to keep all file names unique
	
	$image_name = $random_number . "-" . basename($_FILES['files_upload']['name']);
	
	//Check if name already exists
	$check_query = mysql_query("SELECT * FROM cv_uploads", $db_connect);
	while($row = mysql_fetch_array($check_query)){
		if($row["url"] == $image_name){
			goto start_again;
		}
	}
	
	$date = date("l jS F Y"); // current date to be used when inserting into database	
	
	$target_path = "../uploaded_cv/" . $image_name; //The target path for the uploaded file
	
	if(move_uploaded_file($_FILES['files_upload']['tmp_name'], $target_path)) { // if file uploads to the target path, echo its success. Else display that there was an error. /////
	
		//Insert data into database query 
		$query = mysql_query("
			INSERT INTO cv_uploads
			(url, job_id, applicant_name, applicant_email, date_added)
			
			VALUES
			('{$image_name}','{$job_id}','{$applicant_name}','{$applicant_email}','{$date}')", $db_connect);
		
		if (!$query) {
			die("Whoops, something has gone wrong. Please try again later. Error 101. The server said: " . mysql_error());
		}
		//END Insert data into database query 	
		
		//Grab Last CV ID
		$get_cv_id_query = mysql_query("SELECT * FROM cv_uploads ORDER BY cv_id DESC LIMIT 1", $db_connect);
		if(!$get_cv_id_query){
			die("Whoops, something has gone wrong. Please try again later. Error 102 The server said: ".mysql_error());
		}
		while ($CV_id_row = mysql_fetch_array($get_cv_id_query)){
			$CV_id = $CV_id_row["cv_id"];
		}
		//END Grab Last CV ID	
		
		//Redirect on upload success	
		echo '<script>window.top.location = "../apply.php?id='.$job_id.'&cv_id='.$CV_id.'&status=cv_upload_success"</script>';
	}

	else{ 
			// Redirect on upload fail
			echo '<script>window.top.location = "../apply.php?id='.$job_id.'&status=cv_upload_error"</script>';
		}
}
?>
</body>
</html>