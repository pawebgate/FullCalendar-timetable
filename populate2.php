<?php
	//Setup MySQL connection	
	include 'db_connect.php';
	
	$del = "DELETE from events2";
	if ($con->query($del) === FALSE) 
	{
		echo "Error: " . $del . "<br>" . $con->error;
	}
	//Close MySQL connection
	$con->close();

$sql = "USE CSTIMETABLE
select convert(date, evstart)as res_date, CONVERT(VARCHAR(5),evstart,108) as evstart, 
CONVERT(VARCHAR(5),evend,108) as evend, replace(subject, '''', ' ') as subject, Locations 
FROM [dbo].[v_weekevents]
where evstart > CURRENT_TIMESTAMP and evstart < DATEADD(month,1,CURRENT_TIMESTAMP)
order by res_date";
	
	$result = mssql_query($sql) 
	or die('A error occured: ' . mysql_error());
	
	while ($Row = mssql_fetch_assoc($result)) {
		$evstart = $Row['evstart'];
		$evend = $Row['evend'];
		$subject = $Row["subject"];
		$res_date = $Row["res_date"];
		$locations = $Row["Locations"];
		//Setup connection to MySQL
		include 'db_connect.php';
		//$con->set_charset("iso-8859-7");
		$con->set_charset("greek");
	
	
		$sql = "INSERT INTO events2 (subject, evstart, evend, res_date, locations)VALUES ('$subject', '$evstart', '$evend', '$res_date', '$locations')";
		
		if ($con->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		//Close MySQL connection
		//$con->close();
	}
	
	$con->close();

	//Close SQL Server connection
	mssql_close($link);

	echo "Script run successfully at: ".date('d/m/Y') .'-'. date('h:i:sa');
?>