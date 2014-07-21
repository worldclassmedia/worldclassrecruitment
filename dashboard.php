<?php
require ('header.php');
require ("scripts/admin_includes.php");
?>

<title>Dashboard | World Class Recruitment</title>

<?php //Login Success
if ($_GET["status"] == "success") :?>
	<div id="success_message">Woopie, you've managed to log in. Now do your thing cowboy!</div>
<?php endif; ?>

           <div id='dashboard_content' class='clearfix'>
               <p id='dashboard'>
               Dashboard
               </p>
               <a href="addjob.php"><img id='admin_item' src='img/admin-addjob.jpg' class='image hover' /></a>
               <a href="manage_jobs.php"><img id='admin_item' src='img/Manage Jobs.jpg' class='image hover' /></a>
               <a href="addcategory.php"><img id='admin_item' src='img/Manage_categories.jpg' class='image hover' /></a>
               <a href="addtestimonial.php"><img id='admin_item' src='img/Manage_testimonials.jpg' class='image hover' /></a>
               <a href="applied_jobs.php"><img id='admin_item' src='img/applied_jobs.jpg' class='image hover' /></a>
           </div>
       </div>
       
<?php include ('footer.php') ?>