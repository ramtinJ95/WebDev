<?php 
	ob_start();


	if(!isset($_SESSION))
	{
    	session_start();
	}


	$host = 'localhost';
	$user = 'ramtin';
	$pass = 'hello123';
	$db_name = 'labb';

	$connection = mysqli_connect($host,$user,$pass,$db_name);

	if(!$connection)
	{
		die("Connection to database failed." . mysql_error($connection));
	}
?>