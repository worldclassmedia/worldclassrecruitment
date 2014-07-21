<?php ob_start();
//Grabbing Settings
$success_url = $_POST["success_url"];
$error_url = $_POST["error_url"];
$reply_email = $_POST["reply_email"];

//Grabbing hidden field data.
$email = $_POST["email_address"];
$subject = $_POST["email_subject"];
$headers = 'From: '. $reply_email . "\r\n" .
			'Reply-To: no-reply@worldclassmedia.co.uk' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
//Initalize Message Variable
$message = ""; 

//The Email:
	//Top of email text
	$message .= $_POST["email_top"];
	$message .= "\r\n";
	$message .= "\r\n";
	
	$form_data = $_POST['form_data'];
	
	//The form going into email
	foreach($form_data as $form_header => $form_data){
		
		//Asigning the message fields to $message variable.
		$message .= $form_header.": ".$form_data;
		
		//The spaces inbetweeen
		$message .= "\r\n";
	}
	
	//Bottom of the email
	$message .= "\r\n";
	$message .= "\r\n";
	$message .= $_POST["email_bottom"];

//Check if email is successfully sent
if(mail ($email, $subject, $message, $headers)):?>


	<?php header("location:../../../?page_id=214");?>
		
<?php else: ?>
	
    <?php //header("location: thankyou.html");?>
	Error Message Here (If nothing has worked)

<?php endif;?>