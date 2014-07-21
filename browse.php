<?php include ('header.php') ?>
<title>Browse Jobs | World Class Recruitment</title>





<?php 
//===============Variables===============
?>
<?php $cat_id = $_GET["cat_id"]; ?>
<?php $search_word = mysql_real_escape_string($_GET["search_keyword"]); ?>
<?php $location_word = mysql_real_escape_string($_GET["location"]); ?>

<?php 
//================Location Convertion==============
?>
<?php //Assign location ID 
if(!empty($location_word)){
	
	//Remove spaces
	$location_word = str_replace(" ", "", $location_word);
	//echo "Removed Spaces: ". $location_word;
	
	//Work out if it's a postcode or a location.
	$location_3rd_character = substr($location_word, 2, 1);		//Get third character
	//echo "Third Character: ". $location_3rd_character;
	if(!ctype_alpha($location_3rd_character)){ 		//Check if it's a number or not
		$location_type = "postcode";
		//echo "<br />It's a postcode<br />";
	}
	else {
		$location_type = "city";
		//echo "<br />It's a City<br />";
	}
	
	if($location_type == "postcode"){		//Definding the postcode search, strip down to first or second letter.
		$location_2nd_character = substr($location_word, 1, 1);
		
		//echo "Second Character: " . $location_2nd_character . "<br />";
		
		if(!ctype_alpha($location_2nd_character)){	 //Trim postcode down to one letter, if only one letter in postcode.
			$location_search = substr($location_word, 0, 1);
			//echo "Location Word for only 1 non numberic postcode: ".$location_search."<br />";
		}
		else {		//Trim postcode down to two letters, if only two letter in postcode.
			$location_search = substr($location_word, 0, 2);
			//echo "Location Word for only 2 non numberic postcode: ".$location_search."<br />";
		}
	}
	else {
		$location_search = $location_word;	
	}
	
	
	//The location query
	$location_pre_query = "SELECT * FROM search_locations" ;
	
	if($location_type == 'postcode'){
		$location_pre_query .= " WHERE location_postcode LIKE '{$location_search}'";
	}
	else {
		$location_pre_query .= " WHERE location_name LIKE '%{$location_search}%'";
	}
	
	//echo "location pre query: ".$location_pre_query."<br />";
	
	$location_query = mysql_query($location_pre_query,$db_connect);
	if(!$location_query){
		die("An error occured. Error code: 00 - ".mysql_error());
		}

	while($location_row = mysql_fetch_array($location_query)){
		$location_id = $location_row["location_id"]; //assign location ID
		//echo $location_id;
	}
}
?>

<?php 
//=============Job Querys============
$pre_query = "
SELECT * FROM jobs";	//Start Pre Query

if(!empty($_GET["search_keyword"])){	//Add to pre query from keyword
		$pre_query .= "
		WHERE job_title 
		LIKE '%{$search_word}%'";
}

if(isset($_GET["cat_id"])){	//Add to pre query from cat_id
	$pre_query .= " WHERE cat_id = '$cat_id '";
}

if(!empty($_GET['location']) and !empty($_GET["search_keyword"])){		//Add to pre query from location & search keyword
	$pre_query .= "AND location_id = '$location_id'";
} elseif (!empty($_GET['location'])){	//Add to pre query from location only.
	$pre_query .= " WHERE location_id = '$location_id'";
	}

$pre_query .= " ORDER BY job_id DESC ";	//Pre query order.

//echo "Pre Query:<br /> " . $pre_query . "<br />";

if(!mysql_query($pre_query)){
	die("An error occured. Error code: 01 - ".mysql_error());
}

$job_query = mysql_query($pre_query);		//Error checking pre query
if(!$job_query){
	die("A pre-query error has occured. - Error code: 04 - ".mysql_error());
}
//END Job Queries
?>

<?php 
//=============The Content=============?>

<p id="uploadcv-header">
Browse Jobs.
</p>
<div id="uploadcv-title-line" class="clearfix">
</div>
                
<div id='browse-title-block' class='clearfix'>

   
   <?php if(!mysql_num_rows($job_query) == 0):		//Showing results for section 
       $category_query = mysql_query("
       SELECT * FROM categories 
       WHERE cat_id = '$cat_id' 
       LIMIT 1");
       while($cat_row = mysql_fetch_array($category_query)){
            $category_name = $cat_row["category_name"];
        }
   
       if(isset($_GET["cat_id"])):?>
            <div id="showing_results_for">Showing results for category: <span id ="show_result_for_results"><?php echo stripslashes($category_name) ;?></span></div>
       <?php elseif(!empty($search_word)):		//If they've hit browse without giving a keyword, don't show results message?>
                <div id="showing_results_for">Showing results for: <span id ="show_result_for_results"><?php echo stripslashes($search_word) ;?></span></div>
       <?php elseif($location_type == "postcode"):		//If they've hit browse without giving a keyword, don't show results message?>  
            	 <div id="showing_results_for">Showing results for the postcode:<span id ="show_result_for_results"> <?php echo strtoupper($_GET["location"]); ?></span></div>
       <?php elseif($location_type == "city"):		//If they've hit browse without giving a keyword, don't show results message?>  
            	 <div id="showing_results_for">Showing results for the location: <span id ="show_result_for_results"><?php echo ucfirst($location_word);?></span></div>
       <?php elseif(empty($_GET["location"]) && empty($_GET["search_keyword"])):		//If they've hit browse without giving a keyword, don't show results message?>  
            	 <div id="showing_results_for">Showing all available jobs.</div>
       <?php endif; ?>
   <?php endif;?>
   
</div>
<div id='browse_holder' class='clearfix'>           
<?php while ($row = mysql_fetch_array($job_query)): ?>
       
           <div class='job_info_holder' class='clearfix'> <!-- duplicate -->
           <div id="job_specs" class="clearfix">
               <p id='job_info_title'>
                     <?php echo $row["job_title"]; ?>
               </p>
               <p id='job_salary'>
                    £<?php echo $row["salary"]; ?>
               </p>
               <p id='job_location'>
                    <?php echo $row["location"]; ?>
               </p>
               </div>
               
               <a href="apply.php?id=<?php echo $row["job_id"]; ?>"> <div id="apply_button_browse_jobs">Read More</div></a>
               
               <p id='job_description'>
                    <?php echo nl2br($row["job_description"]); ?>
               </p>
              
                             
           </div> <!-- end job_info_holder -->         

<?php endwhile; ?>

<?php if(mysql_num_rows($job_query) == 0): 	//If no results, give a message?>
<div id="no_results_found">
	<?php if(empty($_GET["location"]) && !isset($_GET["cat_id"])): 		//If just search word doesn't match. ?>
    	Whoops! Unfortantly there are no results for the keyword: <span id="no_results_found_word"><?php echo $search_word; ?></span>
    <?php elseif(empty($_GET["search_keyword"]) && !isset($_GET["cat_id"])): 		//If just location doesn't match.?>
    	Whoops! Unfortantly there are no results for the location: <span id="no_results_found_word"><?php echo $location_word; ?></span>
    <?php elseif(isset($_GET["cat_id"])): 		//If browsed category?>
    	Whoops! Unfortantly there are no results in this category
    <?php else: 		//If both doesn't work.?>
    	Whoops! Unfortantly there are no results for the job <span id="no_results_found_word"><?php echo $search_word; ?></span> in the area <span id="no_results_found_word"><?php echo $location_word; ?>.</span>
    <?php endif;?>
    <p><br /></p>
    <div id='search_holder_top' class='clearfix'>
                       <p id='search_now'>
                       Try and search again?
                       </p>
                       <div id='search_box_1' class='clearfix'>
                       <form method="get" action="browse.php">
                           <input class="enterKeyword" name="search_keyword" type="text" placeholder=" Enter Job Keyword">
                           </div>
                           <div id='search_box_2' class='clearfix'>
                           <input class="enterTown" type="text" name="location" placeholder=" City or Postcode">
                           </div>
                           <input type="image" value="submit" src="img/search.png" id='search_icon'  alt="submit Button" onMouseOver="img/search.png'">
                       </form>
                   </div>
</div>
<?php endif; ?>

</div> <!-- end browse_holder -->
</div>

<?php include ('footer.php') ?>