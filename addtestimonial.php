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
<?php endif; 
if ( $_GET["status"] == 'updated') :?>
	<div id="success_message">You've successfully updated this testimonial</div>
<?php endif; ?>

   <div id='addjob_header_holder' class='clearfix'>
       <p id='add_testimonial_header'>
       Dashboard: Add Testimonial
       </p>
       <a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
   </div>  
   <div id='add_testimonial_content' class='clearfix'>
       <div id='add_testimonial_holder' class='clearfix'>
           <div id='testimonial_name' class='clearfix'>
           <form method="post" action="scripts/add_testimonial_action.php">
               <p id='add_t_name'>
               Name:
               </p>
               <div id='t_name_textarea' class='clearfix'>
                <input id="t_form_name" type="text" style="resize:none" name="name">
               </div>
           </div>
           <div id='testimonial_date' class='clearfix'>
               <p id='add_t_date'>
               Date:
               </p>
               <div id='t_date_textarea' class='clearfix'>
                <input id="t_form_date" type="text" style="resize:none" name="date">
               </div>
           </div>
           <div id='add_testimonial_message' class='clearfix'>
               <p id='add_t_message'>
               Quote:
               </p>
               <div id='t_message_textarea' class='clearfix'>
                <textarea id="t_form_message" type="text" style="resize:none" name="quote"></textarea>
               </div>
           </div>
         
       </div>
       <input type="submit" id="admin_submit" class="submit_button" name="add_job" value="Add Testimonial">
       </form>
   </div>
   
   <?php $show_testimonials_query = mysql_query("SELECT * FROM testimonials ORDER BY test_id DESC"); 
   		  while($test_row = mysql_fetch_array($show_testimonials_query)):
	?>
   <div id="show_testimonial_container" class="clearfix">
            <p id="show_testimonial_name">
            <?php echo $test_row["name"] ;?> - <span id="show_testimonal_date"><?php echo $test_row["date"] ;?></span>
            </p>
            <p id="show_testimonal_content">
            <?php echo $test_row["message"] ;?>
            </p>
            <a href="edittestimonial.php?id=<?php echo $test_row["test_id"] ;?>">
            <p id="show_testimonial_edit">
            Edit
            </p>
            </a>
            <a href="scripts/delete_testimonial_action.php?id=<?php echo $test_row["test_id"] ;?>" onClick="return delete_warning()"><p id="show_testimonial_delete">
            Delete
            </p></a>
     </div>
    <?php endwhile; ?>
</div>
      
<?php include ('footer.php') ?>