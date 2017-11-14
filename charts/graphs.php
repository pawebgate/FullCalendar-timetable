<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Στατιστικά Δέσμευσης Αιθουσών</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
</head>
	<body>
	    <div id="logo"><img src="../img/pic.png" alr="logo" style="width:78px;height:92px;"></div>
	    <div class="container">
            <div class="jumbotron">
                <h1>Στατιστικά Δέσμευσης Αιθουσών</h1>      
            </div>
        </div>
	    <div class="container">
	        <div class="row">
	            
        	    <div class="col-sm-12">
        		    <div class="chart-container">
                        <canvas id="mycanvas1"></canvas>
        		    </div>
        	    </div>
        	</div>
    	</div>
    	<br/>
    	<div class="footer-bottom">
	        <div class="container">
		        <div class="row">
			        <div class="col-sm-12">
				        <div class="design"><a href="#">Πανεπιστήμιο Πειριαώς - Μηχανοργάνωση</a></div>
			        </div>
		        </div>
	        </div>
        </div>
	</body>
</html>