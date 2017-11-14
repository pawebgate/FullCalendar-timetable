<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">

	<link rel="icon" type="image/png" href="http://10.10.1.81/panagiotis/timetable/img/pic.png" />


	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">

	<title>Δέσμευση Αιθουσών</title>

	<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="http://eonasdan.github.io/bootstrap-datetimepicker/css/prettify-1.0.css" rel="stylesheet">
	<link href="http://eonasdan.github.io/bootstrap-datetimepicker/css/base.css" rel="stylesheet">
	<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
	<script src="http://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"></script>
	<script src="http://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"></script>
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker3').datetimepicker();
			$('#datetimepicker4').datetimepicker();
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
			$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});
	</script>
</head>

<body>

<div class="container">
	<h2>Φόρμα Δέσμευσης Αιθουσών</h2>
	<form  action="booking-request.php" method="POST" class="form-block">
	<div class="form-group">
	<label for="dtfrom">Από:</label>
		<div class='input-group date' id='datetimepicker3'>
			<input type='text' id="dtfrom" name="datetimepicker3" class="form-control"/>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
	
	<div class="form-group">
	<label for="dtto">Εως:</label>
		<div class='input-group date' id='datetimepicker4'>
			<input type='text' id="dtto" name="datetimepicker4" class="form-control"/>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
	
	<!--div class="form-group">
		<label for="email">Email:</label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	</div>

	<div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
	</div-->
	
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
		<label for="locations">Επιλογή αίθουσας:</label>
		<select name="locations" id="locations" class="form-control"><option value='' selected></option>
		<?php
		$sql = 'SELECT distinct locations FROM schedule';
		foreach ($pdo->query($sql) as $row) {
					$loc = $row["locations"];
					echo "<option value = '$loc'>".$loc."</option>";
				}
			
		?>
		</select>
	</div>
	
	<div class="form-group">
		
		<label for="evtypedesc">Περιγραφή:</label>
		<select name="evtypedesc" id="evtypedesc" class="form-control"><option value='' selected></option>
		<?php
		$sql = 'SELECT distinct evtypedesc FROM schedule';
		foreach ($pdo->query($sql) as $row) {
					$eve = $row["evtypedesc"];
					echo "<option value = '$eve'>".$eve."</option>";
				}
			Database::disconnect();
		?>
		</select>
	</div>
	
	<!--div class="checkbox">
		<label><input type="checkbox" name="remember"> Remember me</label>
	</div-->
	
	<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>
	<!--script src="http://eonasdan.github.io/bootstrap-datetimepicker/js/prettify-1.0.min.js"></script>
	<script src="http://eonasdan.github.io/bootstrap-datetimepicker/js/base.js"></script-->
</body>
</html>