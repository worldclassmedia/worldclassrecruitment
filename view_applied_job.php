<?php ob_start(); ?>
<?php include ('header.php') ?>
<title>View Applied Jobs | World Class Recruitment</title>



<?php //Variables
$id = $_GET["id"];
$app_id = $_GET["app_id"];
?>

<?php //Queries 
$job_query = mysql_query("SELECT * FROM jobs WHERE job_id = '$id' LIMIT 1",$db_connect);
$screening_query = mysql_query("SELECT * FROM screening_questions WHERE job_id = '$id'",$db_connect);
$screening_query_js = mysql_query("SELECT * FROM screening_questions WHERE job_id = '$id'",$db_connect);
$convert_cv_query = mysql_query("SELECT * FROM applied_jobs WHERE application_id = '$app_id'",$db_connect);
	if(!$convert_cv_query){
		die("An error occured. Error 01: ".mysql_error());
	}
$disregard_status_query = mysql_query("SELECT * FROM applied_jobs WHERE application_id = '$app_id'",$db_connect);
	if(!$disregard_status_query){
		die("An error occured. Error 02: ".mysql_error());
	}
?>

<?php //Success Messages - Job Added
if ($_GET["status"] == "added_job") :?>
	<div id="success_message">
   	 	Congratulation, you've successfully added a job. To manage jobs. Click here.
    </div>
<?php endif; ?>


<?php //While Loop Begin, this will display all the job information into the the area's
while ($job_row = mysql_fetch_array($job_query)):
?>

<?php
//Get CV url
while ($get_cv_id = mysql_fetch_array($convert_cv_query)){
	$cv_id = $get_cv_id["cv_id"];
}
$show_cv_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id='$cv_id'",$db_connect);
while ($get_cv_link = mysql_fetch_array($show_cv_query)){
	$cv_link = $get_cv_link["url"]; //Set CV url variable
	$cv_name = $get_cv_link["applicant_name"]; //Set CV name variable
}
?>
    
<div id='apply_topholder' class='clearfix'>
    <p id='apply_jobtitle'>
		<?php echo nl2br($job_row["job_title"])  ?>
        <div id="job_salary">
            Salary: £<?php echo nl2br($job_row["salary"])  ?>
            <br />Location:
            <?php //Show Location Name (Convert)
            $location_id = $job_row["location_id"];
            $location_query = mysql_query("SELECT * FROM search_locations WHERE location_id = '$location_id'",$db_connect);
            while ($location_row = mysql_fetch_array($location_query)){
            	echo nl2br(ucfirst($location_row["location_name"]));
            }
            ?>
            <br />
            Applicant Name:  <?php echo $cv_name; ?>
        </div>
    </p>
    
    <div id='apply_icons' class='clearfix'>
    <a href="uploaded_cv/<?php echo $cv_link; ?>"> 
    	<button id="admin_submit" class="submit_button">Download CV</button>
    </a>  
    
    <?php //Change disregard button information depending on the application status
    while($disregard_button_info = mysql_fetch_array($disregard_status_query)){ //Disregard Button
    if($disregard_button_info["status"] !== 'disregarded'){
		$diregard_button_class = "disregard_button";
		$diregard_button_value = "Disregard Application";
		$diregard_button_script = "disregard_application.php";
    } else {
		$diregard_button_class = "undisregard_button";
		$diregard_button_value = "Reinstate Application";
		$diregard_button_script = "undisregard_application.php";
    	}
    
	
	if($disregard_button_info["status"] !== 'accepted'){ //Acceptance Button
		$accept_button_class = "accept_button";
		$accept_button_value = "Accept Application";
		$accept_button_script = "accept_application.php";
    } else {
		$accept_button_class = "unaccept_button";
		$accept_button_value = "Revoke Acceptance";
		$accept_button_script = "unaccept_application.php";
    	}
		
	}
    ?>
    <a href="scripts/<?php echo $accept_button_script; ?>?id=<?php echo $app_id; ?>"> 
    	<button id="admin_submit" id="admin_submit" class="<?php echo $accept_button_class; ?>"><?php echo $accept_button_value; ?></button>
    </a>
     <a href="scripts/<?php echo $diregard_button_script; ?>?id=<?php echo $app_id; ?>"> 
    	<button id="admin_submit" class="<?php echo $diregard_button_class; ?>"><?php echo $diregard_button_value; ?></button>
    </a>  
    </div>
</div>

<div id='screening_questions_holder' class='clearfix'>
	<?php 
    while($screening_row = mysql_fetch_array($screening_query)): //While for screening questions ?>
    
    <!------->
    <div id='screening_question_applied' class='clearfix'>
        <p id='screening_question_text'>
        <?php echo $screening_row["question"]; ?>
        </p>
        <div id='screening_question_answer' class='clearfix'>
            <div id='prefered_answer_applied'>Prefered Answer: <?php echo ucfirst($screening_row["prefered_answer"]); ?> <br />Their Answer: 
				<?php
                $question_id = $screening_row["question_id"];
                //Getting there answer
                $answer_query = mysql_query("SELECT * FROM screening_answers WHERE application_id = '$app_id' AND question_id = '$question_id'");
                if(!$answer_query){
                	die("An error occured. Error 02: ".mysql_error());
                }
                while($screening_answer_display = mysql_fetch_array($answer_query)){
					//Display there answer.
					if($screening_answer_display["answer"] == "" || $screening_answer_display["answer"] == NULL){
						echo "None";
					} else {
							echo ucfirst($screening_answer_display["answer"]);
						}
                }
                ?>
            </div>
        </div>
    </div>
    <!------->
    <?php endwhile; //END while for screening questions ?>
</div> <!-- end Screening_questions_holder -->

<div id='job_description_holder' class='clearfix'>
<p id='apply_job_description'>
Job Description
</p>
<p id='apply_job_description1'>
<?php echo nl2br($job_row["job_description"])  ?>
</p>
</div>
<div id='person_specification_holder' class='clearfix'>
<p id='apply_person_specification'>
Person Specification
</p>
<p id='apply_person_specification1'>
<?php echo nl2br($job_row["specification"])  ?>
</p>
</div>
</div>

<?php endwhile; ?>
<?php include ('footer.php') ?>