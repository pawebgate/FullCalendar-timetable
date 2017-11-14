<?php
header('Content-Type: application/json; charset=utf-8');
//header('Content-Type: text/html; charset=iso-8859-7');


define('DB_HOST', 'localhost');
define('DB_USERNAME', 'pan_cy1');
define('DB_PASSWORD', '$pan_cy1');
define('DB_NAME', 'assets');


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("utf8");
//$mysqli->set_charset("latin1");


if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

$query = sprintf("SELECT distinct(locations)as yliko, COUNT(id) as plithos FROM `events` where locations IS NOT NULL GROUP BY locations");

$result = $mysqli->query($query);

$happy1 = array();
foreach ($result as $row){
	$happy1[] = $row;
}

$result ->close();

$mysqli->close();

print json_encode($happy1);

?>