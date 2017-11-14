<?php

	$db_server = 'localhost';
	$username = 'pan_cy1';
	$password = '$pan_cy1';
	$database = 'assets';
	
	//Create connection
	$con = mysqli_connect($db_server,$username,$password,$database);

	mysqli_query($con, "SET NAMES 'utf8'");
	mysqli_query($con, "SET CHARACTER SET 'utf8'");
	
	//Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	//Setup connection to SQL Server
	//$server = 'DBCSOFT-DEV';
	$server = 'SQL-DBCSOFT';

	//$link = mssql_connect($server, 'devuser', '$devus3r');
	$link = mssql_connect($server, 'eunisa', 'CpGfM2HR');

	if (!$link) {
	die('Something went wrong while connecting to MSSQL');
	}
	
	mssql_select_db('CSTIMETABLE')
	or die('Could not select a database.');
?>