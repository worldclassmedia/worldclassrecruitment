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
	if(confirm("You're about to delete this testimonial. This cannot be undone. Are you sure you want to continue?")){
		return true;
		} else {
			return false;
			}
	}
</script>

<?php //Success Messages
if ( $_GET["status"] == 'delete') :?>
	<div id="success_message">You've successfully deleted this testimonial</div>
<?php endif; ?>

   <div id='addjob_header_holder' class='clearfix'>
       <p id='add_testimonial_header'>
       Dashboard: Edit Testimonial
       </p>
       <a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
   </div>  
   
<?php 
$id = $_GET["id"];
$show_testimonials_query = mysql_query("SELECT * FROM testimonials WHERE test_id=$id ORDER BY test_id DESC LIMIT 1"); 
if(!$show_testimonials_query){
	die ("Failed to pull information: ".mysql_error());
	}
   		  while($test_row = mysql_fetch_array($show_testimonials_query)):
	?>
   
   <div id='add_testimonial_content' class='clearfix'>
       <div id='add_testimonial_holder' class='clearfix'>
           <div id='testimonial_name' class='clearfix'>
           <form method="post" action="scripts/edit_testimonial_action.php?id=<?php echo $test_row["test_id"]?>">
               <p id='add_t_name'>
               Name:
               </p>
               <div id='t_name_textarea' class='clearfix'>
                <input id="t_form_name" type="text" style="resize:none" name="name" value="<?php echo $test_row["name"]?>">
               </div>
           </div>
           <div id='testimonial_date' class='clearfix'>
               <p id='add_t_date'>
               Date:
               </p>
               <div id='t_date_textarea' class='clearfix'>
                <input id="t_form_date" type="text" style="resize:none" name="date" value="<?php echo $test_row["date"]?>">
               </div>
           </div>
           <div id='add_testimonial_message' class='clearfix'>
               <p id='add_t_message'>
               Quote:
               </p>
               <div id='t_message_textarea' class='clearfix'>
                <textarea id="t_form_message" type="text" style="resize:none" name="quote"><?php echo $test_row["message"]?></textarea>
               </div>
           </div>
         
       </div>
       <input type="submit" id="admin_submit" class="submit_button" name="add_job" value="Edit Testimonial">
       </form>
   </div>
   
    <?php endwhile; ?>
</div>
      
<?php include ('footer.php') ?>