<?php
/*
=========================================
Pushover Library
Version: 1.0
Author: Jason King, Pushover Online
Licence: www.pushoveronline.co.uk/licence
© Copyright www.pushoveronline.co.uk
=========================================
*/

/*
Options
================================================================================

Beginners Tip: Only change the second part of the defined value, for example: define("example","YOUR SETTING HERE", true).
Beginner friendly tutorials available at http://www.PushoverOnline.com/Learn-Pushover

*/

//Database Connections
define("db_connection", "localhost", true);		//Database Connection
define("db_username", "root", true);				//Database Username
define("db_password", "root", true);				//Database Password
define("db_name", "WCR_DB", true);					//Default Database Name

//Global Website URL
define('global_website_url',"http://worldclassmedia.co.uk/WorldClassRecruitment/");

//MySQL Error Message
define('po_mysql_error_message','Could not delete from the database. Something went wrong! The server said: '.mysql_error());

/*
END Options
================================================================================
*/
?>