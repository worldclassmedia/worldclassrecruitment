<?php include ('header.php') ?>
<title>Testimonials | World Class Recruitment</title>


<?php $display_amount = 10; // Change this to change how many testimonals are shown.?>

<p id='testimonials_header'>
Testimonials
</p>
<div id='testimonials_holder' class='clearfix'>
<?php $testimonal_query = mysql_query("SELECT * FROM testimonials ORDER BY test_id DESC LIMIT $display_amount", $db_connect); 
if(!$testimonal_query){
echo "Could not pull testimonals from database, please try again later: ".mysql_error();
}
while ($test_row = mysql_fetch_array($testimonal_query)):
//While loop for the list items in the slider, pulled from testimonials
?>


<div id='testimonials_content' class='clearfix'> <!-- duplicate group -->
    <p id='name'>
    	<?php echo $test_row["name"] ?>
    </p>
    <p id='date_posted'>
    	<?php echo $test_row["date"] ?>
    </p>
    <img id='image' src='img/symbol_.png' class='image' />
    <p id='testimonial_message'>
    	<?php echo $test_row["message"] ?>
    </p>
</div> <!-- end duplicate -->

<?php endwhile; ?>

<?php $testimonal_query_count = mysql_query("SELECT * FROM testimonials", $db_connect);
$number_of_rows = mysql_num_rows($testimonal_query_count);
$number_of_rows_current = mysql_num_rows($testimonal_query);
?>
<div id="testimonal_count">Displaying <?php echo $number_of_rows_current; ?> out of <?php echo $number_of_rows; ?> testimonials.</div>

</div>
</div>
       
<?php include ('footer.php') ?>