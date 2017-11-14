<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php
$q = $_GET['q'];


include 'database.php';
$pdo = Database::connect();
$sql = "SELECT subject from sche WHERE alias ='$q'";

echo "<option value=''>Choose</option>";
foreach ($pdo->query($sql) as $row) {
	
	$description=$row['subject'];
	
	echo "<option value='$description'>".$description."</option>";
}
Database::disconnect();
?>
</body>
</html>