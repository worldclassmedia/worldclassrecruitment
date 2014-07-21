<?php ob_start(); ?>
<?php include ('header.php') ?>
<title>Apply | World Class Recruitment</title>

<style type="text/css">
</style>


<?php //Variables
$id = $_GET["id"];
$cv_id = $_GET["cv_id"];
$job_id = $_GET["job_id"];
?>

<?php //Queries 
$show_cv_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id='$cv_id'",$db_connect);
if(!$show_cv_query){
	die('Whoops, something wen\'t wrong, please try again. Error 01: '.mysql_error());
	}
$show_job_query = mysql_query("SELECT * FROM jobs WHERE job_id='$job_id'",$db_connect);
if(!$show_job_query){
	die('Whoops, something wen\'t wrong, please try again. Error 02: '.mysql_error());
	}
?>

<?php echo substr($cv_row["url"], 6); ?>
<div id="successful_application">Thank you for applying</div>

<div id="successful_application_cv">
Your Applied Job: 
<?php while ($job_row = mysql_fetch_array($show_job_query)):?>
	<span id="successful_application_cv_span">
		<?php echo $job_row["job_title"]; $job_title = $job_row["job_title"]; ?>
    </span>
<?php endwhile; ?>
</div>

<div id="successful_application_job">
Your CV: 
<?php while ($cv_row = mysql_fetch_array($show_cv_query)):?>
	<span id="successful_application_job_span">
		<?php echo substr($cv_row["url"], 6); ?>
    </span>
<?php endwhile; ?>
</div>

<div id="success_application_id_number">
Your Application Number (Please note this down): 
	<span id="successful_application_cv_span">
		<?php echo $_GET["id"]; ?>
    </span>
</div>

<div id="successfull_application_cv_message">
<div id="what_happens_next_success_message">What Happen's Next?</div>
Now that you’ve gotten the ball rolling towards potentially starting your World Class career by applying for the role of <?php echo $job_title; ?>, we will be busy reviewing your CV. 
<p>&nbsp;</p>
If your experience matches up to the requirements of the job then we will call you to arrange an interview. Please do not be offended if you don’t hear from us straight away! We have a lot of applications being sent to us, but rest assured that we will make it our priority to get back to you within 2 weeks of receiving your CV, whether you were successful or not.
<p>&nbsp;</p>
Until then, why not have a look at the other job opportunities we currently have posted? There is no limit to the amount of World Class careers you can apply for.
</div>
</div>
<?php include ('footer.php') ?>