<?php include ('header.php') ?> 

<?php 
require ("scripts/admin_includes.php"); ?>

<title>View Applied Jobs | World Class Recruitment</title>

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
	if(confirm("You're about to delete this application. This CANNOT be undone. Are you sure you want to continue?")){
		return true;
		} else {
			return false;
			}
	}
</script>

<?php //Success Messages
if ( $_GET["status"] == 'disregarded_job') :?>
	<div id="success_message">
    	You have successfully Disregarded the application. You can view & change the status by clicking "Disregards"
    </div>
<?php endif; 
if ( $_GET["status"] == 'reinstated_job') :?>
	<div id="success_message">
    	You have successfully Reinstated the application.
    </div>
<?php endif; 
if ( $_GET["status"] == 'unaccept_job') :?>
	<div id="success_message">
    	You have successfully Revoked the application.
    </div>
<?php endif; 
if ( $_GET["status"] == 'accept_job') :?>
	<div id="success_message">
    	You have successfully Accepted the application.
    </div>
<?php endif;
if ( $_GET["status"] == 'deleted') :?>
	<div id="success_message">
    	You've successfully deleted this application. An email has been sent notifying the applicant.
    </div>
<?php endif; ?>

<div id='addjob_header_holder' class='clearfix'>
   <p id='add_testimonial_header'>
   		Dashboard: <?php if($_GET["view"] == "view_disregards"):?>Disregards<?php elseif($_GET["view"] == "view_accepted"):?>Accepted<?php else: ?>Applications<?php endif; ?>
   </p>
   <a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
</div> 
   
<div id="change_applied_view" style="clear:both;">
        <a href="?view=">
            <button class="view_disregards">View Applications</button>
        </a>
    	<a href="?view=view_disregards">
        	<button class="view_disregards">View Disregards</button>
        </a>
        <a href="?view=view_accepted">
        	<button class="view_disregards">View Accepted</button>
        </a>
</div>
   
<div id="applied_jobs_container"> 
	<?php if($_GET["view"] == "view_disregards"): //Change the view status in view application query
    	$view_status = "disregarded";
    elseif($_GET["view"] == "view_accepted"):
    	$view_status = "accepted";
	else:
    	$view_status = "applied";
    endif; ?>
    
    <?php 
    $show_applied_jobs_query = mysql_query("SELECT * FROM applied_jobs WHERE status = '$view_status' ORDER BY application_id DESC"); 
    if(!$show_applied_jobs_query){
      die("Could not show applied jobs. Error 01: ".mysql_error());
      }
    while($job_row = mysql_fetch_array($show_applied_jobs_query)): //Show applied jobs loop
        
        //Convert job ID into job information
        $job_id = $job_row["job_id"];
        $convert_job = mysql_query("SELECT * FROM jobs WHERE job_id = $job_id");
        if(!$convert_job){
              die("Could not show applied jobs. Error 02: ".mysql_error());
              }
        while($convert_job = mysql_fetch_array($convert_job)){
            $display_job_name = $convert_job["job_title"];
            $display_job_salary = $convert_job["salary"];
            $display_job_location_id = $convert_job["location_id"];
            }
        //Convert location ID into location name
        $location_convert_query = mysql_query("SELECT * FROM search_locations WHERE location_id = $display_job_location_id LIMIT 1");
        if(!$location_convert_query){
              die("Could not show applied jobs. Error 03: ".mysql_error());
              }
        while ($convert_location = mysql_fetch_array($location_convert_query)){
            $display_location_name = $convert_location["location_name"];
            }
			
		//Get CV ID
		$app_id = $job_row["application_id"];
		$convert_cv_query = mysql_query("SELECT * FROM applied_jobs WHERE application_id = '$app_id'",$db_connect);
		if(!$convert_cv_query){
			die("An error occured. Error 01: ".mysql_error());
		}
		while ($get_cv_id = mysql_fetch_array($convert_cv_query)){
    	$cv_id = $get_cv_id["cv_id"];
    	}
		
		//Get name attached to CV
		$show_cv_query = mysql_query("SELECT * FROM cv_uploads WHERE cv_id='$cv_id'",$db_connect);
   		while ($get_cv_link = mysql_fetch_array($show_cv_query)){
    	$cv_name = $get_cv_link["applicant_name"]; //Set CV url variable
    }
    ?>
        
    <div id="applied_jobs_item" class="clearfix">
        <p id="applied_jobs_info">
            <span id="applied_jobs_info_application_id">
                <?php echo $job_row["application_id"]." (".$cv_name.")"; ?> - 
            </span> 
            <?php echo $display_job_name; ?>:
            <span id="applied_jobs_info_salary_and_city"> 
                 £<?php echo $display_job_salary; ?> - <?php echo ucfirst($display_location_name); ?>
            </span>
        </p>
        <a href="view_applied_job.php?id=<?php echo $job_id ?>&app_id=<?php echo $job_row["application_id"]; ?>">
             <input id="applied_jobs_view_application_button" type="button" value="View Application"></input>
        </a>
        <?php if($_GET["view"] == "view_disregards"): //Show delete button only when viewing disregards ?>
        <a href="scripts/delete_application.php?application_id=<?php echo $job_row["application_id"]; ?>&job_id=<?php echo $job_id ?>&cv_id=<?php echo $cv_id; ?>" onClick="return delete_warning()">
        
        
            <button class="delete_application">Delete Application</button>
        </a>
        <?php endif; ?>
    </div>
    <?php endwhile; //END show applied jobs loop ?>
    
    <?php if(mysql_num_rows($show_applied_jobs_query) == "0"): ?>
    <div id="no_job_applications">
        They're currently no job applications in this sections
    </div>
    <?php endif;?> 
       
</div>
</div>
      
<?php include ('footer.php') ?>