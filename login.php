<?php include ('header.php') ?> 
<title>Login | World Class Recruitment</title>



<?php //Failed to log in.
if ($_GET["status"] == "failed") :?>
	<div id="success_message">Incorrect details, please try again.</div>
<?php endif; ?>

           <div id='admin_content' class='clearfix'>
               <div id='adminbox' class='clearfix'>
                   <p id='admin_login'>
                   Admin Login
                   </p>
                   <div id='diamondstrip_holder' class='clearfix'>
                       <img id='diamond_strip' src='img/diamonds.png' class='image' />
                   </div>
                   <p id='login_username'>
                   Username
                   </p>
                   <div id='username_box' class='clearfix'>
                   <form method="post" action="scripts/login_action.php<?php 
				   if(isset($_GET['ref'])){
					   echo "?ref=".$_GET["ref"];
					   }
				   ?>">
                   <input id="username" type="text" name="username" style="resize:none">
                   </div>
                   <p id='login_password'>
                   Password
                   </p>
                   <div id='password_box' class='clearfix'>
                   <input id="password" type="password" name="password" style="resize:none">
                   <p><br /></p>
                   <input type="submit" id="login_button" class="submit_button" name="add_question" value="Log In"> 
                   </form>
                   </div>
               </div>
           </div>
       </div>
       
<?php include ('footer.php') ?>