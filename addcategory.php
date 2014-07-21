<?php include ('header.php') ?> 

<?php 
require ("scripts/admin_includes.php"); ?>


<title>Add Category | World Class Recruitment</title>

<?php //Success Messages
if ( $_GET["status"] == 'delete') :?>
	<div id="success_message">You've successfully deleted this category</div>
<?php endif; 
if ( $_GET["status"] == 'updated') :?>
	<div id="success_message">You've successfully updated this category</div>
<?php endif; ?>

<script type="application/javascript">
function delete_warning(){
	if(confirm("You're about to delete this category, do you want to continue?")){
		return true;
		} else {
			return false
			}
	}
</script>

           <div id='category_header_holder' class='clearfix'>
               <p id='add_category_header'>
               Dashboard: Add Category
               </p>
               <a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
           </div>
           
           <div id='add_category_holder' class='clearfix'>
                   <p id='add'>
                   Add:
                   </p>
                   <div id='add_category_textarea_holder' class='clearfix'>
                       <div id='add_category_textarea' class='clearfix'>
                       <form action="scripts/add_category_action.php" method="post">
                       	<input id="add_category" name="name" type="text" style="resize:none">
                       
                       </div>
                       <div id='category_submit_holder' class='clearfix'>
                        <input type="submit" id="admin_submit" class="submit_button" name="add_job" value="Add Category">
                        </form>
                       </div>
                   </div>
               </div>
           
           <div id='add_category_conent' class='clearfix'>
				<?php $show_category_query = mysql_query("SELECT * FROM categories ORDER BY cat_id DESC"); 
                while($cat_row = mysql_fetch_array($show_category_query)):
                ?>
                <div id="show_testimonial_container" class="clearfix">
                <p id="show_testimonal_content">
                <?php echo $cat_row["category_name"] ;?>
                </p>
                <a href="editcategory.php?id=<?php echo $cat_row["cat_id"] ;?>">
                <p id="show_testimonial_edit">
                Edit
                </p>
                </a>
                <a href="scripts/delete_category_action.php?id=<?php echo $cat_row["cat_id"] ;?>" onClick="return delete_warning()"><p id="show_testimonial_delete">
                Delete
                </p></a>
                </div>
                <?php endwhile; ?>
                </div>
           </div>
       </div>
       
<?php include ('footer.php') ?>