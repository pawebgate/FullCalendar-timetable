<?php
//header('Content-Type: text/html; charset=iso-8859-7');

$loc = $_GET['locations'];

include 'database.php';
$pdo = Database::connect();

$con = new mysqli('localhost', 'pan_cy1', '$pan_cy1', 'assets');
$con->set_charset("utf8");

if($con->connect_errno > 0){
die('Unable to connect to database [' . $con->connect_error . ']');
}


//$sql = "SELECT subject as title, concat(res_date,'T',evstart, ':00-05:00') as start, concat(res_date,'T',evend,':00-05:00') as end from events2 where res_date >= '2017-10-16' and locations like '%$loc%'";
$sql = "SELECT subject as title, concat(res_date,'T',evstart, ':00-05:00') as start, concat(res_date,'T',evend,':00-05:00') as end from events2 where res_date >= '2017-10-16' and locations = '$loc'";

$result1 = $con->query($sql);

$emparray = array();
while ($row = $result1->fetch_assoc())
{
$emparray[] = $row;
}

$fp = fopen('../json/events2.json', 'w');
fwrite($fp, json_encode($emparray));
fclose($fp);
$con->close();


	/*include 'db_connect.php';
	

	$sql = "USE CSTIMETABLE
SELECT distinct replace(title, '''', ' ') as title,  
convert(date, evstart)as res_date,
concat (CONVERT(VARCHAR(5),evstart,108)) as start, 
concat (CONVERT(VARCHAR(5),evend,108)) as end

from UNIEvents 
inner join UNIEventType on UNIEvents.evTypeID = UNIEventType.evtypeID
inner join UNILocation on UNIEvents.Locations = UNILocation.loName

inner join UNILocCategories on UNILocation.loID = UNILocCategories.locID

inner join UNISite on UNILocation.loSiteID = UNISite.siID 
inner join UNIModule on UNIEvents.subject = UNIModule.title
inner join GLB_DEPARTMENT on UNIModule.depID = GLB_DEPARTMENT.ID
--where evstart like '%2017%' order by evID
where evstart > CURRENT_TIMESTAMP and UNILocCategories.catID = 1 and evstart < DATEADD(month,6,CURRENT_TIMESTAMP)";
	
	$result = mssql_query($sql) 
	or die('A error occured: ' . mysql_error());
	$emparray = array();
	while ($Row = mssql_fetch_assoc($result)) {
		$emparray[] = $row;
	}
	
	
	$fp = fopen('../json/events2.json', 'w');
	fwrite($fp, json_encode($emparray));
	fclose($fp);
	mssql_close($link);*/


//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

// Read and parse our events JSON file into an array of event data arrays.
$json = file_get_contents(dirname(__FILE__) . '/../json/events2.json');
$input_arrays = json_decode($json, true);

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}

// Send JSON to the client.
echo json_encode($output_arrays);