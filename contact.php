<?php include ('header.php') ?> 
<title>Contact | World Class Recruitment</title>

<script>
	$(document).ready(function(){
	po_form_validator('This field is required', 'Please enter a valid email address', 'please enter a valid phone number','Please select an option','Please check something');
	});
</script>


<div id="contact-block" class="clearfix">
            <div id="contact-container" class="clearfix">
                <p id="contact-header">
                Get In Touch.
                </p>
                <div id="contact-title-line" class="clearfix">
                </div>
                <div id="contact-form-block" class="clearfix">
                
                <form action="mail_action_contact.php" name="contact_form" method="POST">
               
               <!--Hidden information data | To keep this working, only change values NOT names
               !!These need to be set!!-->
               <input type="hidden" name="email_address" value="danielmorris@gmail.com" />
               <input type="hidden" name="email_subject" value="Contact Form" />
               <input type="hidden" name="email_top" value="This message has been sent from:" />
               <input type="hidden" name="email_bottom" value="Please respond to this request within 24 hours." />
               <input type="hidden" name="reply_email" value="no-reply@worldclassrecruitment.co.uk" />
                
                    <input name="form_data[Name]" placeholder="Name" id="contact-name-input" class="po_validate">
                    
                    <input name="form_data[Number]" placeholder="Number" id="contact-number-input" class="po_validate_phone">
                    
                    <input name="form_data[Email]" placeholder="Email" id="contact-email-input" class="po_validate_email">
                    
                    <textarea class="form_info po_validate" id="contact-message-input" placeholder="Message" name="form_data[Message]" type="text" style="resize:none"></textarea>
                    
                    
                    <input type="submit" value="Submit" id="contact-submit" class="po_submit_form">
                    
                    </form>

                </div>
                <div id="contact-info-block" class="clearfix">
                    <p id="Got_a_Question_">
                    Got a Question&#x3f;<br />
                    </p>
                    <p id="contact-text-1">
                    Feel free to give us a call during office hours &#x28;9-5 monday to friday&#x29;, alternatively, send us a message using the contact form, we&#x27;ll try and get back to you as soon as possible.<br />
                    </p>
                    <p id="Contact_Details_">
                    Contact Details&#x3a;<br />
                    </p>
                    <p id="contact-text-2">
                    World Class Recruitment<br />St James Court<br />Cannon Street<br />Bristol<br />BS1 3LH<br /><br />Tel&#x3a; 07985 416052<br /><br />phoebe.sheppard&#x40;worldclassrecruitment.co.uk<br />
                    </p>
                </div>
            </div>
        </div>
        <div id="stay-connected-block" class="clearfix">
            <div id="stay-connected-container" class="clearfix">
                <p id="stay-connected">
                Stay Connected.
                </p>
                <div id="stay-connected-line" class="clearfix">
                </div>
                <div id="stay-connected-social-icons" class="clearfix">
                    <img id="stay-connected-facebook" src="img/facebook-black.png" class="image" />
                    <img id="stay-connected-twitter" src="img/twitter-black.png" class="image" />
                    <img id="stay-connected-linkedin" src="img/indesign-black.png" class="image" />
                </div>
            </div>
        </div>
       
<?php include ('footer.php') ?>