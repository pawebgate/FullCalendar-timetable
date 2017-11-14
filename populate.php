<?php
	//Setup MySQL connection	
	include 'db_connect.php';
	
	$del = "DELETE from events";
	if ($con->query($del) === FALSE) 
	{
		echo "Error: " . $del . "<br>" . $con->error;
	}
	//Close MySQL connection
	$con->close();

	/*$sql = "USE CSTIMETABLE
SELECT evID, dayofWeek, convert(date, evstart)as res_date,CONVERT(VARCHAR(5),evstart,108) as evstart, 
CONVERT(VARCHAR(5),evend,108) as evend, replace(subject, '''', ' ') as subject, UNIEvents.evTypeID, 
evtypedesc, wkpattern, Locations as locations, siName  from UNIEvents 
inner join UNIEventType on UNIEvents.evTypeID = UNIEventType.evtypeID
inner join UNILocation on UNIEvents.Locations = UNILocation.loName
inner join UNISite on UNILocation.loSiteID = UNISite.siID 
--where evstart like '%2017%' order by evID
where evstart > CURRENT_TIMESTAMP and evstart < DATEADD(month,6,CURRENT_TIMESTAMP) order by evID";*/

$sql = "USE CSTIMETABLE
SELECT distinct replace(title, '''', ' ') as title, replace(GLB_DEPARTMENT.name, '''', ' ') as name, evID, dayofWeek, 
convert(date, evstart)as res_date,CONVERT(VARCHAR(5),evstart,108) as evstart, 
CONVERT(VARCHAR(5),evend,108) as evend, replace(subject, '''', ' ') as subject, UNIEvents.evTypeID, 
evtypedesc, wkpattern, Locations as locations, siName, capacity,

CASE micro
WHEN '1' THEN 'Υπάρχει'
WHEN '0' THEN 'Δεν υπάρχει'
END AS micro,

CASE blackboard
WHEN '1' THEN 'Υπάρχει'
WHEN '0' THEN 'Δεν υπάρχει'
END AS blackboard,

CASE projector
WHEN '1' THEN 'Υπάρχει'
WHEN '0' THEN 'Δεν υπάρχει'
END AS projector,

CASE video
WHEN '1' THEN 'Υπάρχει'
WHEN '0' THEN 'Δεν υπάρχει'
END AS video

from UNIEvents 
inner join UNIEventType on UNIEvents.evTypeID = UNIEventType.evtypeID
inner join UNILocation on UNIEvents.Locations = UNILocation.loName

inner join UNILocCategories on UNILocation.loID = UNILocCategories.locID

inner join UNISite on UNILocation.loSiteID = UNISite.siID 
inner join UNIModule on UNIEvents.subject = UNIModule.title
inner join GLB_DEPARTMENT on UNIModule.depID = GLB_DEPARTMENT.ID
--where evstart like '%2017%' order by evID
where evstart > CURRENT_TIMESTAMP and UNILocCategories.catID = 1 and evstart < DATEADD(month,6,CURRENT_TIMESTAMP) order by evID";
	
	$result = mssql_query($sql) 
	or die('A error occured: ' . mysql_error());
	
	while ($Row = mssql_fetch_assoc($result)) {
	
		$evID = $Row['evID'];
		$mera = $Row['dayofWeek'];
		$res_date = $Row['res_date'];
		$evstart = $Row['evstart'];
		$evend = $Row['evend'];
		$subject = $Row["subject"];
		$evtypedesc = $Row['evtypedesc'];
		$locations = $Row['locations'];
		$siName = $Row['siName'];
		$name = $Row['name'];
		$capacity = $Row['capacity'];
		$micro = $Row['micro'];
		$blackboard = $Row['blackboard'];
		$projector = $Row['projector'];
		$video = $Row['video'];
		
		//Setup connection to MySQL
		include 'db_connect.php';	
		//$con->set_charset("iso-8859-7");
		$con->set_charset("greek");

		$sql = "INSERT INTO events (evID, dayofWeek, res_date, evstart, evend, subject, evtypedesc, locations, siName, name, capacity, micro, blackboard, projector, video)VALUES ('$evID', '$mera', '$res_date', '$evstart', '$evend', '$subject', '$evtypedesc', '$locations', '$siName', '$name', '$capacity','$micro', '$blackboard', '$projector', '$video')";
		
		if ($con->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		//Close MySQL connection
		//$con->close();
	}
	
	
	
	
	$sql = "USE CSTIMETABLE
		select distinct loID, loName, capacity from UNILocation
		inner join UNILocCategories on UNILocation.loID = UNILocCategories.locID
		where catID = 2";

	$result = mssql_query($sql) 
	or die('A error occured: ' . mysql_error());

	while ($Row = mssql_fetch_assoc($result)) {
		$capacity2 = $Row['capacity'];
		$loName = $Row['loName'];
		
		$sql = "UPDATE events set capacity2 = '$capacity2' where locations = '$loName'";
		
		if ($con->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		
	}
	
	$con->close();

	//Close SQL Server connection
	mssql_close($link);

	echo "Script run successfully at: ".date('d/m/Y') .'-'. date('h:i:sa');
?>