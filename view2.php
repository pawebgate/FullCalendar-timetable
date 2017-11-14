<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Εύρεση Προγράμματος βάση Αίθουσας και Ημερομηνίας</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/png" href="http://10.10.1.81/panagiotis/timetable/img/pic.png" />
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  
	<script>
	$( function() {
	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
	} );
	</script>

</head>
<body>

<div class="container">
  <h2>Εύρεση Προγράμματος βάση Αίθουσας και Ημερομηνίας</h2>
  <form class="form-inline" action="view2-request.php" method="post">
    <div class="form-group">
      <label for="datepicker">Από:</label>
      <input type="text" class="form-control" id="datepicker" name="datepicker">
    </div>

    <div class="form-group">
      <label for="datepicker2">Εως:</label>
      <input type="text" class="form-control" id="datepicker2" name="datepicker2">
    </div>

    

    <div class="form-group">
		<?php 
			include 'database.php';
			$pdo = Database::connect();
		?>
		<label for="name">Αίθουσα</label>
		<select name="locations" id="locations" class="form-control" ><option value=''></option>
		<?php
		$sql = 'SELECT distinct locations from events order by locations';

		foreach ($pdo->query($sql) as $row) {
					$locations = $row["locations"];
					
					echo "<option value = '$locations'>".$locations."</option>";
				}
			
		?>
		</select>
	</div>


    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>

