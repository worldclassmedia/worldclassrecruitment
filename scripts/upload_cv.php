<?php 
ob_start();
define("DIRPATH", TRUE);
require('../pushover_library.php');
 ?>

<!DOCTYPE html>
<html>
   <head>   
	<link rel="stylesheet" href="../stylesheets/upload_styles.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
<body>
<!--Upload Status Messages-->
<?php if($_GET["status"] == "too_large"):?>
<div id="upload_error_message">
Whoops. The file you're trying to upload is too large! Must be under 10MB</div>
<?php endif; ?>

<?php if($_GET["status"] == "wrong_type"):?>
<div id="upload_error_message">
Whoops. The file you're trying to upload is the wrong file type. Must be: .doc, .docx or .pdf</div>
<?php endif; ?>

<script type="application/javascript">
function file_name(){
	var filename = document.getElementById("select_file").value;
	var filename = filename.replace("C:\\fakepath\\","");
	
	//Show new selected file name
	document.getElementById("file_name_text").innerHTML=filename;
	
	//Change select button style.
	document.getElementById("upload_file_button").style.opacity="0.5";
	document.getElementById("upload_file_button").style.filter="alpha (opacity:50)";
	
	//Change upload button style.
	document.getElementById("upload_file_submit").style.opacity="1";
	document.getElementById("upload_file_submit").style.filter="alpha (opacity:100)";
	document.getElementById("upload_file_submit").style.pointerEvents = "visible";
	}
	
	$(document).ready(function() {
		
		$('#required_name').hide();
		$('#required_email').hide();
		
        $('#upload_upload_button').click(function(){
			if($("#upload_cv_name").val() == "" || $("#upload_cv_name").val() == null){
				$('#required_name').show();
				} else if($("#upload_cv_name").val() !== "" || $("#upload_cv_name").val() !== null) {
					$('#required_name').hide();
					}
					
			if($("#upload_cv_email").val() == "" || $("#upload_cv_email").val() == null){
				$('#required_email').show();
				} else if($("#upload_cv_email").val() !== "" || $("#upload_cv_email").val() !== null) {
					$('#required_email').hide();
					}
						
			//Email regular expression check.
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var email = $("#upload_cv_email").val();
			
			if(!filter.test(email) && $("#upload_cv_email").val() !== ""){
				$('#required_email').show();
				$('#required_email').text("Not a valid email address, try again.");
				} else if($("#upload_cv_email").val() == "" || $("#upload_cv_email").val() == null) {
					$('#required_email').text("A valid email is required");
					}		
					
			if($("#upload_cv_name").val() == "" || $("#upload_cv_name").val() == null || $("#upload_cv_email").val() == "" || $("#upload_cv_email").val() == null || !filter.test(email)){
				return false;
				}
			});
    });
</script>

<div id="upload_form_container">
    <form enctype="multipart/form-data" action="upload_cv_action.php?id=<?php echo $_GET["id"] ?>" method="post">
        <div id="upload_form_header">Upload CV</div>
        <div id="upload_form_description">Please select your CV then upload it. Your CV must be under 10MB and be one of the follow file types: .doc, .docx or .pdf.
        </div>
        <div id="upload_cv_name_container">
       		<input name="upload_cv_name" id="upload_cv_name" class="upload_cv_input" placeholder="Name">
            <div class="required_field" id="required_name">A valid name is required</div>
        </div>
        <div id="upload_cv_name_container">
       		<input name="upload_cv_email" id="upload_cv_email" class="upload_cv_input" placeholder="Email Address">
            <div class="required_field" id="required_email">A valid email is required</div>
        </div>
        <div id="upload_file_button" class="animate">
        	<input name="files_upload" class="upload_select_button" onChange="file_name()" id="select_file" type="file"/>
            <div id="fake_button_select">Select</div>
        </div>
        <div id="upload_file_submit" class="animate">
            <input type="submit" id="upload_upload_button" value="Upload File" />
            <div id="fake_submit_select">Upload </div>
        </div>
    </form>

<div id="file_name">
	<div id="file_name_img"><img src="../img/cv_icon.png" width="45" height="45" alt=""/></div>
	<div id="file_name_text">No file selected...</div>
</div>

</div>
</body>
</html>