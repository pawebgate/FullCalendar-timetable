<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<?php
include 'database.php';
$pdo = Database::connect();
?>

<?php
	$first = $_POST['datepicker'];
	$last = $_POST['datepicker2'];
	$locations = $_POST['locations'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link href="../img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Πρόγραμμα Ημέρας βάση Αίθουσας</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script>	
	var min=8;
	var max=18;
	function increaseFontSize() {
	   var div = document.getElementsByTagName('div');
	   for(i=0;i<div.length;i++) {
		  if(div[i].style.fontSize) {
			 var s = parseInt(div[i].style.fontSize.replace("px",""));
		  } else {
			 var s = 12;
		  }
		  if(s!=max) {
			 s += 1;
		  }
		  div[i].style.fontSize = s+"px"
	   }
	}
	function decreaseFontSize() {
	   var div = document.getElementsByTagName('div');
	   for(i=0;i<div.length;i++) {
		  if(div[i].style.fontSize) {
			 var s = parseInt(div[i].style.fontSize.replace("px",""));
		  } else {
			 var s = 12;
		  }
		  if(s!=min) {
			 s -= 1;
		  }
		  div[i].style.fontSize = s+"px"
	   }   
	}
	</script>
	
</head>
<body>
	<div class="container">          
		<div class="row">
			<a href="javascript:decreaseFontSize();"><img src="img/decrease.png" width="20" height="20"></a>
			<a href="javascript:increaseFontSize();"><img src="img/increase.png" width="20" height="20"></a>
		</div>
		
		<div class="row">
			<p>Πρόγραμμα αίθουσας <?php echo '<b>'.$locations.'</b>'; ?> μεταξύ <?php echo '<b>'.$first.'</b>'; ?> - <?php echo '<b>'.$last.'</b>'; ?></p>
		</div>
		
		<div class="row">
			<?php $char = "select distinct locations, capacity, capacity2, micro, blackboard, projector, video, siName from schedule where locations='$locations'";
			foreach ($pdo->query($char) as $row)
			{
				$pinakas = $row['blackboard'];
				if($pinakas == "Υπάρχει")
				{
					$pinakas = "διαθέτει";
				}
				else
				{
					$pinakas = "δεν διαθέτει";
				}
				
				$projector = $row['projector'];
				if($projector == "Υπάρχει")
				{
					$projector = "διαθέτει";
				}
				else
				{
					$projector = "δεν διαθέτει";
				}
				
				$video = $row['projector'];
				if($video == "Υπάρχει")
				{
					$video = "διαθέτει";
				}
				else
				{
					$video = "δεν διαθέτει";
				}
				
				$micro = $row['micro'];
				if($micro == "Υπάρχει")
				{
					$micro = "διαθέτει";
				}
				else
				{
					$micro = "δεν διαθέτει";
				}
				
			}
			?>
			
			<p><?php echo "Αίθουσα ".$locations." ".'<b>'.$pinakas.'</b>'." Πίνακα ".'<b>'.$projector.'</b>'." Projector ".'<b>'.$video.'</b>'."  Video ".'<b>'.$micro.'</b>'." Μικρόφωνο "; ?></p>
		</div>
		
		<div class="row">
			
			<?php

			$sql1 = "select distinct dayofWeek, res_date from schedule where res_date <= '$last' and res_date >= '$first' and locations = $locations order by res_date";

			foreach ($pdo->query($sql1) as $row)
			{
			$mera = $row['dayofWeek'];
				if ($mera==1)
				{
					$day = "Δευτέρα";
				}
				if ($mera==2)
				{
					$day = "Τρίτη";
				}
				if ($mera==3)
				{
					$day = "Τετάρτη";
				}
				if ($mera==4)
				{
					$day = "Πέμπτη";
				}
				if ($mera==5)
				{
					$day = "Παρασκευή";
				}
				if ($mera==6)
				{
					$day = "Σάββατο";
				}
				if ($mera==7)
				{
					$day = "Κυριακή";
				}
				echo'<table class="table table-striped"><thead><tr><th colspan="3">'.$day." ".$row['res_date'].'</th></tr></thead><tbody>';
				
				$sql = "select dayofWeek, res_date, evstart, evend, name, subject, siName from events where res_date <= '$last' and res_date >= '$first' and locations = $locations and dayofWeek = '$mera' order by res_date";
				
				foreach ($pdo->query($sql) as $row)
				{
					$d1 = $row['evstart']." - ".$row['evend'];
					echo '<tr><td>'.$d1.'</td><td>'.$row['name'].'</td><td>'.$row['subject'].'</td><td>'.$row['siName'].'</td></tr>';
				}
				echo'</tbody></table><br>';
			}
			?>
			
		</div>
	</div>
	<br />
	<br />
	
	<?php
		Database::disconnect();
	?>	
  </body>
</html>