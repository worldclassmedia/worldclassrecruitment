<?php //ob_start(); ?>
<?php include ('header.php') ?>
<title>Apply | World Class Recruitment</title>

<div id="apply-block" class="clearfix">
            <div id="apply-container" class="clearfix">
<!--Fancybox jQuery-->
    	 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        
        <script type="text/javascript">
			$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 510,
					minWidth	: 280,
					maxHeight	: 700,
					fitToView	: false,
					width		: '45%',
					height		: '80%',
					autoSize	: false,
					closeClick	: false,
					openEffect	: 'none',
					closeEffect	: 'none'
				});
			});
		</script>
     <!--END Fancybox jQuery-->

<?php //Variables
$id = $_GET["id"];
$cv_id = $_GET["cv_id"];
?>

<?php //Queries 
$job_query = mysql_query("SELECT * FROM jobs WHERE job_id = '$id' LIMIT 1",$db_connect);
$screening_query = mysql_query("SELECT * FROM screening_questions WHERE job_id = '$id'",$db_connect);
$screening_query_js = mysql_query("SELECT * FROM screening_questions WHERE job_id = '$id'",$db_connect);
$show_cv_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id='$cv_id'",$db_connect);
?>

<?php //Success Messages - Job Added
if ($_GET["status"] == "added_job") :?>
	<div id="success_message">Congratulation, you've successfully added a job. To manage jobs. Click here.</div>
<?php endif; ?>

<?php //Success Messages - Cv Uploaded
if ($_GET["status"] == "cv_upload_success") :?>
	<div id="success_message">Your CV has been successfully uploaded. You can now apply for this job.</div>
<?php endif; ?>

<?php //Error Messages - Cv Uploaded
if ($_GET["status"] == "cv_upload_error") :?>
	<div id="error_message">Whoopsie, This is some what embarressing. The CV couldn't be uploaded. Please try again.</div>
<?php endif; ?>

<script type="application/javascript">
function validateForm() {
	<?php //While for screening questions, this will echo out all screening questions
    while($screening_row_JS = mysql_fetch_array($screening_query_js)):?>
	//New Loop
    var radios<?php echo $screening_row_JS["question_id"]; ?> = document.getElementsByName("screening_answer[<?php echo $screening_row_JS["question_id"]; ?>]");
    var formValid<?php echo $screening_row_JS["question_id"]; ?> = false;
    var i<?php echo $screening_row_JS["question_id"]; ?> = 0;
    while (!formValid<?php echo $screening_row_JS["question_id"]; ?> && i<?php echo $screening_row_JS["question_id"]; ?> < radios<?php echo $screening_row_JS["question_id"]; ?>.length) {
        if (radios<?php echo $screening_row_JS["question_id"]; ?>[i<?php echo $screening_row_JS["question_id"]; ?>].checked) formValid<?php echo $screening_row_JS["question_id"]; ?> = true;
        i<?php echo $screening_row_JS["question_id"]; ?>++;
    }
    if (!formValid<?php echo $screening_row_JS["question_id"]; ?>) {
        alert("You need to answer all questions before you can continue!")
		return false;
    }
	
	<?php endwhile;?>
}
</script>

<?php //While Loop Begin, this will display all the job information into the the area's
while ($job_row = mysql_fetch_array($job_query)):
?>
    <div id='apply_topholder' class='clearfix'>
        <p id='apply_jobtitle'>
        <?php echo nl2br($job_row["job_title"])  ?>
        <div id="job_salary">
        Salary: £<?php echo nl2br($job_row["salary"])  ?>
        <br />Location:
        <?php
		$location_id = $job_row["location_id"];
		$location_query = mysql_query("SELECT * FROM search_locations WHERE location_id = '$location_id'",$db_connect);
		while ($location_row = mysql_fetch_array($location_query))
		{
		echo nl2br(ucfirst($location_row["location_name"]));
		}
		?>
        </div>
        </p>
        
        <?php if($_GET["status"] == "cv_upload_success"):?>
        <form action="scripts/apply_process.php?job_id=<?php echo $id;?>&cv_id=<?php echo $cv_id ;?>" onSubmit="return validateForm()" name="screening_question"  method="post">
        <?php else: ?>
        <form method="post">
        <?php endif; ?>
        
        <div id='apply_icons' class='clearfix'>
        <?php //Changing the process button, upload CV & Apply ?>
        <?php if($_GET["status"] == "cv_upload_success"): ?>
        <input type="submit" id="apply_icons" class="submit_button" name="apply" value="Apply">
        <?php else: ?> 
        <a class="various" data-fancybox-type="iframe" href="scripts/upload_cv.php?id=<?php echo $job_row["job_id"]; ?>">
        <input type="button" id="apply_icons" class="submit_button" name="upload_cv" value="Apply">       
        </a>  		      
        <?php endif; ?>
        </div>
    </div>
    
    <?php //Show Uploaded CV
	if(!$show_cv_query){
		die("Cannot' find CV from ID :" . mysql_error());
		}
	while ($cv_row = mysql_fetch_array($show_cv_query)):?>
    	<div id="CV_name">CV Uploaded: <span id="cv_file_name"><?php echo substr($cv_row["url"], 6); ?></span></div>
    <?php endwhile; ?>
    
    <!--<div id="apply_message">Please make sure your CV contains your name and contact details before uploading and applying for this job.</div>-->
    
    <div id='screening_questions_holder' class='clearfix' <?php if($_GET["status"] == "cv_upload_success"){}else{echo 'style="opacity:0.4"';}?>>
    <?php //While for screening questions, this will echo out all screening questions
    while($screening_row = mysql_fetch_array($screening_query)):?>
  
        <!------->
        <div id='screening_question' class='clearfix'>
            <p id='screening_question_text'>
            <?php echo $screening_row["question"]; ?>
            </p>
            <div id='screening_question_answer'  class='clearfix'>
                
                <div id='input_box' class='clearfix'>
                <input <?php if($_GET["status"] !== "cv_upload_success"){echo "disabled";}?> type="radio" name="screening_answer[<?php echo $screening_row["question_id"]; ?>]" id="form_validation" value="yes" class="input_yes form_verify">Yes
                <input <?php if($_GET["status"] !== "cv_upload_success"){echo "disabled";}?> type="radio" name="screening_answer[<?php echo $screening_row["question_id"]; ?>]" id="form_validation" value="no" class="input_no form_verify">No
                </div>
            </div>
        </div>
        <!------->
    <?php endwhile; ?>
    </form>
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

</div>
</div>
<?php include ('footer.php') ?>