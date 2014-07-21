<?php
/*
User Data Area; Use this area for your own custom variables, functions or anything you want to include.
================================================================================
*/

//Variables:

//Funtions:
function clean_salary($salry){
	$return_salary = $salry;
	$return_salary = str_replace(array('£','$',' '),'',$return_salary);
	$return_salary = str_replace(array('k','K'),',000',$return_salary);
	if($return_salary > 999){
		$return_salary = number_format($return_salary);
		}
	return $return_salary;
	}
	
//Other:

/*
================================================================================
END User Data Area
*/