<?php include ('header.php') ?>
<title>Categories | World Class Recruitment</title>

 

<?php $query = mysql_query("SELECT * FROM categories"); //Query ?>

           <div id='browse_by_category_holder' class='clearfix'>
               <p id='browse_by_category'>
               Browse by Category
               </p>
           </div>
           <div id='category_content' class='clearfix'>
           <?php while ($row = mysql_fetch_array($query)):?>
               <a href="browse.php?cat_id=<?php echo $row["cat_id"]; ?>">
                   <div id='category_box' class='clearfix animation'> <!-- duplicate div -->
                        <?php echo $row["category_name"]; ?>
                   </div> <!-- end duplicate div --> 
               </a>
            <?php endwhile; ?>
           </div>
       </div>

<?php include ('footer.php') ?>