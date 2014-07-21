<?php include ('header.php') ?> 

<?php 
require ("scripts/admin_includes.php"); ?>

<title>Add Testimonial | World Class Recruitment</title>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
	$(function() {
		$( "#t_form_date" ).datepicker();
	});
</script>

<script type="application/javascript">
	function delete_warning(){
		if(confirm("You're about to delete this job. This cannot be undone. Are you sure you want to continue?")){
			return true;
		} else {
			return false;
		}
	}
</script>

<?php //Success Messages
if ( $_GET["status"] == 'delete') :?>
	<div id="success_message">You've successfully deleted this job</div>
<?php endif; 
if ( $_GET["status"] == 'updated') :?>
	<div id="success_message">You've successfully updated this job</div>
<?php endif; ?>

<div id='addjob_header_holder' class='clearfix'>
    <p id='add_testimonial_header'>
    	Dashboard: Manage Jobs
    </p>
	<a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
</div>  

<?php $show_job_query = mysql_query("SELECT * FROM jobs ORDER BY job_id DESC"); 
	if(!$show_job_query){
		die("Whoops, cannot select from the the database. Error Code - 01: ".mysql_error());
	}

while($job_row = mysql_fetch_array($show_job_query)): //While Job Loop
?>

<?php 
$location_id = $job_row["location_id"]; //Convert location ID
$show_job_location_convert = mysql_query("SELECT * FROM search_locations WHERE location_id = '$location_id'");
	if(!$show_job_location_convert){
		die("Whoops, cannot select from the the database. Error Code - 02: ".mysql_error());
	}
	
while ($job_location = mysql_fetch_array($show_job_location_convert)): //Start loop for the location convertions
?>

<div id="show_testimonial_container" class="clearfix">
    <p id="show_testimonial_name">
    	<?php echo $job_row["job_title"];?> - <span id="show_testimonal_date"><?php echo "£".$job_row["salary"] ;?> - <?php echo ucfirst($job_location["location_name"]) ;?></span> 
    </p>
    <p id="show_testimonal_content">
    	<?php echo substr($job_row["job_description"], 0, 60)."..." ;?>
    </p>
    <a href="editjob.php?id=<?php echo $job_row["job_id"] ;?>">
        <p id="show_testimonial_edit">
            Edit
        </p>
    </a>
    <a href="scripts/delete_job_action.php?id=<?php echo $job_row["job_id"] ;?>" onClick="return delete_warning()">
        <p id="show_testimonial_delete">
            Delete
        </p>
    </a>
</div>
<?php endwhile; //End location loop?>
<?php endwhile; //End Job Loop?>
</div>

<?php include ('footer.php') ?>