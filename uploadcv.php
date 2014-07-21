<?php
/*
Template Name: Contact
*/
 ?>

<?php include ('header.php'); ?>

 <!-- Add fancyBox -->
        <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        
        <script type="text/javascript">
			$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 510,
					minWidth	: 280,
					maxHeight	: 700,
					fitToView	: false,
					width		: '45%',
					height		: '80%',
					autoSize	: false,
					closeClick	: false,
					openEffect	: 'none',
					closeEffect	: 'none'
				});
			});
		</script>
     <!--END Fancybox jQuery-->

<script>
	$(document).ready(function(){
	po_form_validator('This field is required', 'Please enter a valid email address', 'please enter a valid phone number','Please select an option','Please check something');
	});
</script>

<script>

$(document).ready(function(e) {
		var max = 4;
		var checkbox_type = $('input[type="checkbox"]');
		
		checkbox_type.change(function(){
        var current = checkbox_type.filter(':checked').length;
        checkbox_type.filter(':not(:checked)').prop('disabled', current >= max);
    });
});
</script>

<script>

$(document).ready(function(e) {
	$('.uploadcv-cat').click(function(){
		var checkboxes = $('input:checkbox[name=job-type]');
		
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){
			$(this).css({
			'background-color': 'rgb(255, 255, 255)'		
			});
			$(this).css({
			'border': '5px solid rgb(237, 237, 237)'
			});
			$(this).find(checkboxes).attr("checked", false);			
		} else {		
			$(this).css({
			'background-color': 'rgb(205, 179, 208)'		
			});
			$(this).css({
			'border-color': 'rgb(205, 179, 208)'
			});
			$(this).find(checkboxes).attr("checked", true);	
			}
	});	
	
	

	
	
	
	$('.uploadcv-permanent').click(function(){
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){	
		$(this).css({
		'background-color': 'rgb(237, 237, 237)'		
		});			
		$(this).find('input:checkbox[name=job-type]').attr("checked", false);
		} else {	
		$(this).css({
		'background-color': 'rgb(205, 179, 208)'		
		});
		$(this).find('input:checkbox[name=job-type]').attr("checked", true);
		}
	});	
	
	$('.uploadcv-temp-fixed').click(function(){
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){	
		$(this).css({
		'background-color': 'rgb(237, 237, 237)'		
		});			
		$(this).find('input:checkbox[name=job-type]').attr("checked", false);
		} else {	
		$(this).css({
		'background-color': 'rgb(205, 179, 208)'		
		});
		$(this).find('input:checkbox[name=job-type]').attr("checked", true);
		}
	});	
	
	$('.uploadcv-contract').click(function(){
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){	
		$(this).css({
		'background-color': 'rgb(237, 237, 237)'		
		});			
		$(this).find('input:checkbox[name=job-type]').attr("checked", false);
		} else {	
		$(this).css({
		'background-color': 'rgb(205, 179, 208)'		
		});
		$(this).find('input:checkbox[name=job-type]').attr("checked", true);
		}
	});	
	
	$('.uploadcv-part-time').click(function(){
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){	
		$(this).css({
		'background-color': 'rgb(237, 237, 237)'		
		});			
		$(this).find('input:checkbox[name=job-type]').attr("checked", false);
		} else {	
		$(this).css({
		'background-color': 'rgb(205, 179, 208)'		
		});
		$(this).find('input:checkbox[name=job-type]').attr("checked", true);
		}
	});	
	
	$('.uploadcv-any').click(function(){
		if($(this).css('background-color') == 'rgb(205, 179, 208)'){	
		$(this).css({
		'background-color': 'rgb(237, 237, 237)'		
		});			
		$(this).find('input:checkbox[name=job-type]').attr("checked", false);
		} else {	
		$(this).css({
		'background-color': 'rgb(205, 179, 208)'		
		});
		$(this).find('input:checkbox[name=job-type]').attr("checked", true);
		}
	});	
	
	
});

</script>


<div id="uploadcv-block" class="clearfix">
            <div id="uploadcv-container" class="clearfix">
                <p id="uploadcv-header">
                Upload Your CV.
                </p>
                <div id="uploadcv-title-line" class="clearfix">
                </div>
                <div id="uploadcv-info-block" class="clearfix">
                    <p id="leave-it-to-us">
                    Leave it to us.<br />
                    </p>
                    <p id="uploadcv-text-1">
                    Feel free to give us a call during office hours &#x28;9-5 monday to friday&#x29;, alternatively, send us a message using the contact form, we&#x27;ll try and get back to you as soon as possible.<br />
                    </p>
                </div>
                <div id="uploadcv-form-block" class="clearfix">
                
                <form action="mail_action_contact.php" name="contact_form" method="POST">
               
               <!--Hidden information data | To keep this working, only change values NOT names
               !!These need to be set!!-->
               <input type="hidden" name="email_address" value="danielmorris@gmail.com" />
               <input type="hidden" name="email_subject" value="Contact Form" />
               <input type="hidden" name="email_top" value="This message has been sent from:" />
               <input type="hidden" name="email_bottom" value="Please respond to this request within 24 hours." />
               <input type="hidden" name="reply_email" value="no-reply@worldclassrecruitment.co.uk" />
                
                	<p id="uploadcv-personal-details">
                    Personal Details.<br />
                    </p>
                
                	<div id="uploadcv-name-input" class="clearfix">
                    <input name="form_data[Name]" placeholder="Name" id="" class="po_validate uploadcv-field"> 
                    </div>                   
                    
                    <div id="uploadcv-number-input" class="clearfix">
                    <input name="form_data[Number]" placeholder="Number" id="" class="po_validate_phone uploadcv-field">   
                    </div>
                       
                    <div id="uploadcv-email-input" class="clearfix">                 
                    <input name="form_data[Email]" placeholder="Email" id="" class="po_validate_email uploadcv-field">  
                    </div>
                          
                    <div id="uploadcv-postcode-input" class="clearfix">                 
                    <input name="form_data[Postcode]" placeholder="Postcode" id="" class="po_validate uploadcv-field">
                    </div>
                    
                    <p id="uploadcv-preferences">
                    Preferences<br />
                    </p>
                    
                    <div id="uploadcv-jobtitle" class="clearfix">
                    <input name="form_data[Title]" placeholder="Job Title" id="" class="po_validate uploadcv-field">
                    </div>
                    
                    <div id="uploadcv-skills" class="clearfix">
                    <input name="form_data[Skills]" placeholder="Skills" id="" class="po_validate uploadcv-field">
                    </div>
                    
                    <div id="uploadcv-desired-location" class="clearfix">
                    <input name="form_data[Location]" placeholder="Desired Location" id="" class="po_validate uploadcv-field">
                    </div>
                    
                    <p id="uploadcv-jobtype">
                    Job Type.<br />
                    </p>
                    <div class="uploadcv-permanent" class="clearfix">
                    <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check"><p id="checkbox-text">Permanent</p>
                    </div>
                    <div class="uploadcv-temp-fixed" class="clearfix">
                    <input type="checkbox" name="job-type" value="Temporary/Fixed Term" class="uploadcv-check"><p id="checkbox-text">Temporary/Fixed Term</p>
                    </div>
                    <div class="uploadcv-contract" class="clearfix">
                    <input type="checkbox" name="job-type" value="Contract" class="uploadcv-check"><p id="checkbox-text">Contract</p>
                    </div>
                    <div class="uploadcv-part-time" class="clearfix">
                    <input type="checkbox" name="job-type" value="Part-Time" class="uploadcv-check"><p id="checkbox-text">Part-Time </p>
                    </div>
                    <div class="uploadcv-any" class="clearfix">
                    <input type="checkbox" name="job-type" value="Any" class="uploadcv-check"><p id="checkbox-text">Any</p>
                    </div>
                    
                    
					
                    
                    
                    
                    </div>
                    <div id="uploadcv-category-block" class="clearfix">
                        <p id="uploadcv-yoursectors">
                        Your Sectors. (maximum of 4)<br />
                        </p>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">IT</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">Web Design</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">Graphic Design</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">Sales</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">Customer Services</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="true" class="uploadcv-check-cat"><p id="checkbox-text-cat">Administration</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">Telesales</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">Accountancy</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">HR</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">Showroom Advisor</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">Warehouse Operative</p>
                        </div>
                        <div class="uploadcv-cat" class="clearfix">
                        <input type="checkbox" name="job-type" value="Permanent" class="uploadcv-check-cat"><p id="checkbox-text-cat">Technician</p>
                        </div>
                    </div>
      
                    <div id="uploadcv-submit-container" class="clearfix">
                        
                        
                        <div id='apply_icons' class='clearfix'>
						<?php //Changing the process button, upload CV & Apply ?>
                        <?php if($_GET["status"] == "cv_upload_success"): ?>
                        <input type="submit" id="admin_submit" class="submit_button" name="apply" value="Apply">
                        <?php else: ?> 
                        <a class="various" data-fancybox-type="iframe" href="scripts/upload_cv.php?id=<?php echo $job_row["job_id"]; ?>">
                        <input type="button" id="uploadcv-upload" class="submit_button po_validate" name="upload_cv" value="Upload Your CV">       
                        </a>  		      
                        <?php endif; ?>
                        </div>
                        
                        
                        <input type="submit" value="Submit" id="uploadcv-submit" class="po_submit_form">
                    </div>
                    
                    </form>
                </div>
          
        <div id="job-alerts-block" class="clearfix">
            <div id="job-alerts-info-block" class="clearfix">
                <p id="job-alerts">
                Job Alerts.
                </p>
                <div id="job-alerts-line" class="clearfix">
                </div>
                <p id="job-alerts-text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br />
                </p>
            </div>
        </div>


<?php include ('footer.php'); ?>