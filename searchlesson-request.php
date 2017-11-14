<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<?php
	$subject = $_POST['subject']; 
	$name = $_POST['name']; 
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

</head>

<body>

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

			<table id="example" class="display" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>Αίθουσα</th>
					<th>Χωρ 1</th>
					<th>Χωρ 2</th>
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
					$sql = "select * from schedule where subject='$subject' and name = '$name'";
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
						echo '<td>'. $row['siName'] . '</td>';
						//echo '<td>'. $row['res_date'] . '</td>'; 
						echo '<td>'. date("d/m/Y", strtotime($row['res_date'])) . '</td>'; 
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
</body>
</html>