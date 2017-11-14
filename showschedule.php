<?php
//header('Content-Type: text/html; charset=iso-8859-7');
?>

<?php
	//include 'populate.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="http://10.10.1.81/panagiotis/timetable/img/pic.png" />
	
	<title>Αναλυτική Χρήση Αιθουσών</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<link rel="stylesheet" href="css/dynamic.css">
	
	<script>
	$(document).ready(function() {
		//$( "#datepicker" ).datepicker();
		// Setup - add a text input to each footer cell
		$('#example tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		});

		// DataTable
		var table = $('#example').DataTable();

		// Apply the search
		table.columns().every( function () {
			var that = this;

			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
					.search( this.value )
					.draw();
				}
			});
		});
	});
	</script>

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

	<script>
	$( function() {
	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });

	} );
	</script>

	<script>
		function validateForm()
		{
			var first = document.getElementById("datepicker").value;
			var last = document.getElementById("datepicker2").value;
			
			//if ($.datepicker.parseDate('dd/mm/yy', GuarantyTo) < $.datepicker.parseDate('dd/mm/yy', GuarantyFrom))
			if (last < first)
 
			{
				alert('End Date ' + 'is earlier than ' + 'Start Date');
				return false;
			}
		}
	</script>

<style>
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    /*background-color: #111;*/
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
	
background: rgba(0, 0, 0, 0.50) none repeat scroll 0 0;
    color: white;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    color: white;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>

<body>

<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="http://10.10.1.81/panagiotis/timetable/booking.php">Booking</a>
  <a href="#">Contact</a>
  <a href="charts/graphs.php" target="_blank"><img src="img/charts.png" alt="charts" width="20" height="20">&nbsp;Charts</a>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

	<div class="container-fluid">
		<div class="row">
			<a href="javascript:decreaseFontSize();"><img src="img/decrease.png" width="20" height="20"></a>
			<a href="javascript:increaseFontSize();"><img src="img/increase.png" width="20" height="20"></a>
		</div>
		<div class="row">
			<h3>Timatable</h3>
		</div>
		<div class="row">	
		
			<form  action="dump3.php" method="POST" class="form-block" onsubmit="return validateForm()">
			<!-- Form will send its results to the output file-->

			<div class="field">
			<label for="datepicker">Από:</label>
			<input type="text" id="datepicker" name="datepicker">
			<!--/div-->

			<!--div class="field"-->
			<label for="datepicker2">Εως:</label>
			<input type="text" id="datepicker2" name="datepicker2">
			<!--/div-->

			<!--div class="field"-->
			<label for="locations">Αίθουσα:</label>
			<input type="text" id="locations" name="locations">

			<button type="submit">Submit</button>
			<button type="reset">Clear</button>
			
			</div>
			</form>
			
			<br />
		
			<table id="example" class="display" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>Αίθουσα</th>
					<th>Χωρ 1</th>
					<th>Χωρ 2</th>
					
					<th>Mic</th>
					<th>Πίνακας</th>
					<th>Proj</th>
					<th>Video</th>
					
					<th>Τοποθεσία</th>
					<th>Ημ/νία</th>
					<th>Ημέρα</th>
					<th>Έναρξη</th>
					<th>Λήξη</th>
					<th>Μάθημα</th>
					<th>Περιγραφή</th>
					<th>Τμήμα</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th>Αίθουσα</th>
					<th>Χωρ 1</th>
					<th>Χωρ 2</th>
					
					<th>Mic</th>
					<th>Πίνακας</th>
					<th>Proj</th>
					<th>Video</th>
					
					<th>Τοποθεσία</th>
					<th>Ημ/νία</th>
					<th>Ημέρα</th>
					<th>Έναρξη</th>
					<th>Λήξη</th>
					<th>Μάθημα</th>
					<th>Περιγραφή</th>
					<th>Τμήμα</th>
				</tr>
				</tfoot>
				<tbody>
					<?php 
					include 'database.php';
					$pdo = Database::connect();
					//$sql = "select dayofWeek, res_date, evstart as start, evend as end, subject, evtypedesc, locations, siName, capacity from events";
					$sql = "select * from events";
					//schedule is a view
					foreach ($pdo->query($sql) as $row) {
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
						echo '<tr>';
						echo '<td>'. $row['locations'] . '</td>';
						echo '<td>'. $row['capacity'] . '</td>';
						echo '<td>'. $row['capacity2'] . '</td>';
						
						echo '<td>'. $row['micro'] . '</td>';
						echo '<td>'. $row['blackboard'] . '</td>';
						echo '<td>'. $row['projector'] . '</td>';
						echo '<td>'. $row['video'] . '</td>';
						
						echo '<td>'. $row['siName'] . '</td>';
						echo '<td>'. $row['res_date'] . '</td>';  
						echo '<td>'. $day . '</td>';
						//echo '<td>'. $row['start'] . '</td>';
						echo '<td>'. $row['evstart'] . '</td>';
						//echo '<td>'. $row['end'] . '</td>';
						echo '<td>'. $row['evend'] . '</td>';
						echo '<td>'. $row['subject'] . '</td>';
						echo '<td>'. $row['evtypedesc'] . '</td>';
						echo '<td>'. $row['name'] . '</td>';
						
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
    	</div>
    </div> <!-- /container -->
		<?php
		//include('footer.php');
	?>
	<div class="container-fluid">
	<div class="row">            
		<a href="charts/graphs.php" target="_blank"><img src="img/charts.png" alt="charts" width="100" height="100"></a>
	</div>
	</div>

</body>
</html>