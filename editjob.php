<?php require ('header.php') ?> 

<?php 
require ("scripts/admin_includes.php"); ?>

<?php $id = $_GET["id"]; ?>
<?php $form_query = mysql_query("SELECT * FROM jobs WHERE job_id = '$id'");?>
<?php $cat_query = mysql_query("SELECT * FROM categories");?>
<?php $location_query = mysql_query("SELECT * FROM search_locations ORDER BY location_name");?>

<title>Update Job | World Class Recruitment</title>

<?php //Success Messages
if ($_GET["status"] == "updated_question") :?>
	<div id="success_message">You've successfully updated a the job. You can either continue editing or finnish by clicking Update Job</div>
<?php endif;?>

<?php if ($_GET["status"] == "added_question") :?>
	<div id="success_message">You've successfully added a screening question. You can either add some more or finnish by clicking Update Job</div>
<?php endif;?>

<?php if ($_GET["status"] == "deleted_question") :?>
	<div id="success_message">You've successfully deleted a screening question. You can either add some more or finnish by clicking Update Job</div>
<?php endif;?>




<script type="text/javascript">
function form_checker() {
	var checker_title = document.forms["add_job_form"]["job_title"].value;
	var checker_salary = document.forms["add_job_form"]["salary"].value;
	var checker_description = document.forms["add_job_form"]["description"].value;
	var checker_person = document.forms["add_job_form"]["person_spec"].value;
	
	if(checker_salary == null || checker_salary == '' ||
		checker_salary == null || checker_salary == '' ||
		checker_description == null || checker_description == '' ||
		checker_person == null || checker_person == ''
	){
		alert("You need to fill out all job fields before you can continue.");
		return false;
		}
}
function check_question(){
	var question = document.forms["add_job_form"]["question"].value;
	if(question == null || question == ''){
		alert("You can't add a blank question!");
		return false;
		}
	}
	
</script>

           <div id='addjob_header_holder' class='clearfix'>
               <p id='add_new_job_header'>
               Dashboard: Update Job
               </p>
               <a href="dashboard.php"><img id='return_icon' src='img/return_icon.png' class='image' /></a>
           </div>
           <div id='add_job_form' class='clearfix'>
               <div id='job_form_holder' class='clearfix'>
                    <form action="scripts/update_job.php?id=<?php echo $_GET["id"];?>" name="add_job_form" method="post" onSubmit="return form_checker()">
                                
<?php while ($row = mysql_fetch_array($form_query)): //Step 2?>
                   <div id='job_title_holder' class='clearfix'>
                       <p id='job_title'>
                       Job Title:
                       </p>
                       <div id='job_title_textarea' class='clearfix'>
                           <input id="form_job_title" name="job_title" type="text" value="<?php echo $row["job_title"] ?>" style="resize:none">
                       </div>
                   </div>
                   <div id='salary_holder' class='clearfix'>
                       <p id='salary'>
                       Salary:
                       </p>
                       <div id='salary_textarea' class='clearfix'>
                       	<input id="form_salary" name="salary" type="text" value="<?php echo $row["salary"] ?>" style="resize:none">
                       </div>
                   </div>
                   <div id='description_holder' class='clearfix'>
                       <p id='description'>
                       Description:
                       </p>
                       <div id='description_textarea' class='clearfix'>
                      	 <textarea id="form_description" name="description" type="text" style="resize:none"><?php echo $row["job_description"] ?></textarea>
                       </div>
                   </div>
                   <div id='person_spec_holder' class='clearfix'>
                       <p id='person_spec'>
                       Person Specification:
                       </p>
                       <div id='person_spec_textarea' class='clearfix'>
                     	    <textarea id="form_person_spec" name="person_spec" type="text" style="resize:none"><?php echo $row["specification"] ?></textarea>
                       </div>
                       
                       <div id="select_catergory_list" class="clearfix dropdown dropdown-dark">
                        <select name="category_id" class="dropdown-select">
                       <?php //Select options - Categories ?>
						    <?php //Selected row ?>
							   <?php //Selected row queries ?>
                                   <?php $select_cat_id = $row["cat_id"]; ?>
                                   <?php $cat_query_selected = mysql_query("SELECT * FROM categories WHERE cat_id ='$select_cat_id'");?>
                              <?php //END Selected row queries ?>
                           
							    <?php while ($cat_row_selected = mysql_fetch_array($cat_query_selected)):?>
                               <option selected value="<?php echo $cat_row_selected["cat_id"]; ?>"><?php echo $cat_row_selected["category_name"]; ?></option>
                               <?php endwhile; ?>
                           <?php //END Selected row ?>
                           
                           <?php while ($cat_row = mysql_fetch_array($cat_query)):?>
                           <option value="<?php echo $cat_row["cat_id"]; ?>"><?php echo $cat_row["category_name"]; ?></option>
                           <?php endwhile; ?>
                           </select>
                         </div>
                         
                        <div id="select_catergory_list" class="clearfix dropdown dropdown-dark">
                        <select name="location_id" class="dropdown-select">
                      	  <?php //Select options - Locations ?>
						    <?php //Selected row ?>
							   <?php //Selected row queries ?>
                                   <?php $select_location_id = $row["location_id"]; ?>
                                   <?php $location_query_selected = mysql_query("SELECT * FROM search_locations WHERE location_id ='$select_location_id'");?>
                              <?php //END Selected row queries ?>
                           
							    <?php while ($location_row_selected = mysql_fetch_array($location_query_selected)):?>
                               <option selected value="<?php echo $location_row_selected["location_id"];?>"><?php echo ucfirst($location_row_selected["location_name"])." - ".strtoupper($location_row_selected["location_postcode"]);?></option>
                               <?php endwhile; ?>
                           <?php //END Selected row ?>
                           
                           
                           <?php while ($location_row = mysql_fetch_array($location_query)):?>
                            <option value="<?php echo $location_row["location_id"];?>"><?php echo ucfirst($location_row["location_name"])." - ".strtoupper($location_row["location_postcode"]);?></option>
                           <?php endwhile; ?>
                        </select>
                         </div>
<?php endwhile; ?>

                   
                   </div>
                   </div>
               
               <div id='screening_questions_content' class='clearfix'>
                   <p id='screening_questions'>
                   Screening Questions:
                   </p>
                   <div id='screening_questions_holder' class='clearfix'>
                   <?php /*Display Screening Questions*/ 
				   	$screening_questions_query = mysql_query("SELECT * FROM screening_questions WHERE job_id = '$id'");
					if(!$screening_questions_query){
						die("Whoops, could not display screening questions, something went wrong. The server said: ".mysql_error());
						}
					
				 	while ($screening_row = mysql_fetch_array($screening_questions_query)):	
				   ?>
                       <div id='screening_question_duplicate' class='clearfix'>
                       <?php echo $screening_row["question"]; ?> - <span class="prfered_answer_span">Prefered Answer:</span> <span class="prefered_answer_span_green"><?php echo ucfirst($screening_row["prefered_answer"])?></span><span class="delete_pre_answer"><a href="scripts/delete_question.php?id=<?php echo $screening_row["question_id"] ?>&job_id=<?php echo $id ?>&return_url=update_job">X</a></span>
                       </div>
                       
                   <?php endwhile; ?>
                   </div>
                   <p id='screening_questions1'>
                   Add Question:
                   </p>
                   <div id='add_question_holder' class='clearfix'>
                       <div id='add_question_textarea' class='clearfix'>
                       	<textarea id="add_question" name="question" type="text" style="resize:none"></textarea>
                       </div>
                       <div class="prefferedanswer_list">
                          <select name="prefered_answer" class="prefferedanswer_select">
                            <option value="none">Answer</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                          </select>
                      </div>
                   </div>
               </div>
               		<input type="submit" id="admin_submit" class="submit_button" name="update_job" value="Update Job"> 
                   <input type="submit" id="admin_submit" class="submit_button" name="add_question" onClick="return check_question()" value="Add Question"> 
               <!--<a href="#"><img id='admin_submit' src='img/admin_submit_button.png' /></a>-->
             </form>
           </div>
       </div>
<?php include ('footer.php') ?>