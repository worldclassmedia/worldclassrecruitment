<?php ob_start();define("DIRPATH", TRUE);require('pushover_library.php');?> 
<!DOCTYPE html>
<html>
<head>   
   
   <script src="modernizr.js"></script>
   <script>var __adobewebfontsappname__ = "reflow"</script>
   <script src="http://use.edgefonts.net/carme:n4:all;gfs-didot:n4:all.js"></script>
   <script type="text/javascript" src="scripts/modernizr.custom.79639.js"></script> 
   <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
   
   <script src="js/po_js_library.js"></script>
    
    <script>
	//Stick scroll menu
	$(document).ready(function(e) {
       $(document).scroll(function(){
		if($(document).scrollTop() > 232){
		$("#nav-block").css("position","fixed");
		$("#nav-block").css("top","0px");
		$("#nav_fixture_blank").css("height","50px");
		};
		if($(document).scrollTop() < 232){
		$("#nav-block").css("position","relative");
		$("#nav-block").css("marginTop","0px");
		$("#nav_fixture_blank").css("height","0px");
		};
		});
    });		
	</script>
    
    <script>

	$(document).ready(function() {
		$(document).scroll(function(){
			var paralax_scroll = $(document).scrollTop();
			var paralax_scroll_calculated = paralax_scroll * 0.55;
			$('#main-search-block').css('background-position','0px 0px, 0px -' + paralax_scroll_calculated + 'px')
			});
	});
	
	$(document).ready(function() {
		$(document).scroll(function(){
			var paralax_scroll = $(document).scrollTop();
			var paralax_scroll_calculated = paralax_scroll * 0.55;
			$('#stay-connected-block').css('background-position','0px 0px, 0px -' + paralax_scroll_calculated + 'px')
			});
	});
	
	</script>
    
    <script>
		$(document).ready(function(){
		po_form_validator('This field is required', 'Please enter a valid email address', 'please enter a valid phone number','Please select an option','Please check something');
		});
	</script> 
    
    <!--<link rel="stylesheet" href="stylesheets/styles.css" />
    <link rel="stylesheet" href="stylesheets/contact.css" />
    <link rel="stylesheet" href="stylesheets/category.css" />
    <link rel="stylesheet" href="stylesheets/slider.css" />
    <link rel="stylesheet" href="stylesheets/testimonials.css" />
    <link rel="stylesheet" href="stylesheets/responsiveslides.css" />    
    <link rel="stylesheet" href="stylesheets/login.css" />    
    <link rel="stylesheet" href="stylesheets/dashboard.css" />
    <link rel="stylesheet" href="stylesheets/addjob.css" />
    <link rel="stylesheet" href="stylesheets/addcategory.css" />
    <link rel="stylesheet" href="stylesheets/addtestimonial.css" />-->
    
    
    	<link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/style4.css" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" />
        <link rel="stylesheet" type="text/css" href="css/contact.css" />
        <link rel="stylesheet" type="text/css" href="css/uploadcv.css" />
        <link rel="stylesheet" type="text/css" href="css/browse.css" />
        <link rel="stylesheet" type="text/css" href="css/apply.css" />
        <link rel="stylesheet" href="css/boilerplate.css" />
        <link rel="stylesheet" href="css/styles.css" />
    
    <!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="stylesheets/IE_9.css" />
	<![endif]-->
	
        
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="img/favicon.png" />
    
            
   </head>
<body>

<?php
if(isset($_SESSION["username"])):?>
<div id ="admin_area" class="animation">
	<span id="admin_area_text">Admin Area</span><p><br /><p>
   	<a class="admin_links" href="dashboard.php">Dashboard</a> <p>
    <a class="admin_links" href="scripts/logout_action.php">Log Out</a>
</div>
<?php endif; ?>

<div id="primaryContainer" class="primaryContainer clearfix">
    <div id="tablet-nav-block" class="clearfix">
            <p id="tablet-tap-for-menu">
            Tap For Menu
            </p>
        </div>
        <div id="header-block" class="clearfix">
            <div id="header-image-block" class="clearfix">
                <img id="header-tablet" src="img/top-logo-tablet.png" class="image" />
                <img id="header-main" src="img/header.png" class="image" />
            </div>
        </div>
        <div id="nav-block" class="clearfix">
            <div id="nav-button-container" class="clearfix">
            
                 <ul class="ul">
                  <a href="index.php"><li class="li">HOME</li></a>
                  <li>ABOUT</li>
                  <li>
                   <a href="browse.php"> JOBS</a>
                    <ul>
                      <a href="browse.php"><li>RECENT JOBS</li></a>
                      <li>VIEW CATEGORIES</li>
                      <li>PARTNERS</li>
                      <a href="uploadcv.php"><li>UPLOAD YOUR CV</li></a>
                    </ul>
                  </li>
                  <li>ADVICE</li>
                  <li>TESTIMONIALS</li>
                  <a href="contact.php"><li style="border-right:1px #511a55 solid;">CONTACT</li></a>
                </ul>
				            
            <div id="nav-search" class="clearfix">
                </div>
                
            </div>
        </div>
        
        
        <div id="nav_fixture_blank"></div>