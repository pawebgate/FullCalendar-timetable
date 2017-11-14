<?php
header('Content-Type: text/html; charset=iso-8859-7');
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
		$( function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();

		} );
	</script>
	
</head>

<body>
<?php
//include('header.php');
?>
    <div class="container">
    		<div class="row">
    			<h3>Timatable</h3>
    		</div>
			<div class="row">
				<p>
					
				</p> 
					  
					<table id="example" class="display" width="100%" cellspacing="0">
					<thead>
					<tr>
						<th>Ημ/νία</th>
						<th>Ημέρα</th>
						<th>Έναρξη</th>
						<th>Λήξη</th>
						<th>Μάθημα</th>
						<th>Περιγραφή</th>
						<th>Αίθουσα</th>
						<th>Τοποθεσία</th>
					</tr>
					</thead>
					<tfoot>
					<tr>
						<th>Ημ/νία</th>
						<th>Ημέρα</th>
						<th>Έναρξη</th>
						<th>Λήξη</th>
						<th>Μάθημα</th>
						<th>Περιγραφή</th>
						<th>Αίθουσα</th>
						<th>Τοποθεσία</th>					</tr>
					</tfoot>
					<tbody>
					<?php 
					include 'database.php';
					$pdo = Database::connect();
					if((!empty($first)) && (!empty($last)) && (!empty($locations)))
					{
						$sql = "select dayofWeek, res_date, evstart as start, evend as end, subject, evtypedesc, locations, siName from events where res_date <= '$last' and res_date >= '$first' and locations = $locations";
					}
					if((!empty($first)) && (!empty($last)) && (empty($locations)))
					{
						$sql = "select dayofWeek, res_date, evstart as start, evend as end, subject, evtypedesc, locations, siName from events where res_date <= '$last' and res_date >= '$first'";
					}
					if((empty($first)) && (empty($last)) && (!empty($locations)))
					{
						$sql = "select dayofWeek, res_date, evstart as start, evend as end, subject, evtypedesc, locations, siName from events where locations = $locations";
					}	
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
						
						echo '<td>'. $row['res_date'] . '</td>';  
						echo '<td>'. $day . '</td>';
						echo '<td>'. $row['start'] . '</td>';
						echo '<td>'. $row['end'] . '</td>';
						echo '<td>'. $row['subject'] . '</td>';
						echo '<td>'. $row['evtypedesc'] . '</td>';
						echo '<td>'. $row['locations'] . '</td>';
						echo '<td>'. $row['siName'] . '</td>';
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
	<br />
	<br />
		
  </body>
</html>