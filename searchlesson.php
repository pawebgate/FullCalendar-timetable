<?php
header('Content-Type: text/html; charset=iso-8859-7');
//header('Content-Type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Εύρεση Πληροφοριών Μαθήματος</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/png" href="http://10.10.1.81/panagiotis/timetable/img/pic.png" />
  
	<script>
	function showUser(str) {
	if (str=="") {
	document.getElementById("subject").innerHTML="";
	return;
	}
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (this.readyState==4 && this.status==200) {
	  document.getElementById("subject").innerHTML=this.responseText;
	}
	}
	xmlhttp.open("GET","getuser.php?q="+str,true);
	xmlhttp.send();
	}
	</script>
  
</head>
<body>

<div class="container">
  <h2>Εύρεση Πληροφοριών Μαθήματος</h2>
  <form  action="searchlesson-request.php" method="POST" class="form-block">

	<div class="form-group">
		<?php 
			include 'database.php';
			$pdo = Database::connect();
		?>
		<label for="name">Τμήμα</label>
		<select name="name" id="name" class="form-control" onchange="showUser(this.value)"><option value=''></option>
		<?php
		$sql = 'SELECT distinct name, alias from sche order by name';

		foreach ($pdo->query($sql) as $row) {
					$name = $row["name"];
					$alias = $row["alias"];
					echo "<option value = '$alias'>".$name."</option>";
				}
			
		?>
		</select>
	</div>
	
	<div class="form-group">
		<label for="subject">Μάθημα</label>
		<select name="subject" id="subject" class="form-control"><option value=''></option>
		
		</select>
	</div>
	
	
	
	<?php Database::disconnect(); ?>
    
	<button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
