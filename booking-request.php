<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<?php
	$evtypedesc = $_POST['evtypedesc'];
	$locations = $_POST['locations'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link href="../img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	
	
</head>

<body>


<?php
	$datetimepicker3 = $_POST['datetimepicker3'];
	echo "Ημ/νία - Ώρα Από: ".$datetimepicker3;
	$datetimepicker4 = $_POST['datetimepicker4'];
	echo "<br>"."Ημ/νία - Ώρα Εως: ".$datetimepicker4;
	$evtypedesc = $_POST['evtypedesc'];
	echo "<br>"."Περιγραφή: ".$evtypedesc;
	$locations = $_POST['locations'];
	echo "<br>"."Αίθουσα: ".$locations;
	
	require 'phpmailer/mail.php';
?>
		
</body>
</html>