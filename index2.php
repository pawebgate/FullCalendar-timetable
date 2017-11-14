<?php
header('Content-Type: text/html; charset=iso-8859-7');
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
	
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<h3>Timatable</h3>
		</div>
		<div class="row">	
		
			<form  action="dump.php" method="POST" class="form-block" onsubmit="return validateForm()">
			<!-- Form will send its results to the output file-->

			<div class="field">
			<label for="datepicker">Από: </label>
			<input type="text" id="datepicker" name="datepicker">
			<!--/div-->

			<!--div class="field"-->
			<label for="datepicker2">Εως: </label>
			<input type="text" id="datepicker2" name="datepicker2">
			<!--/div-->

			<!--div class="field"-->
			<label for="locations">Αίθουσα: </label>
			<input type="text" id="locations" name="locations">

			<button type="submit">Submit</button>
			<button type="reset">Clear</button>
			
			</div>
			</form>
			
			<br />
		
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
					<th>Τοποθεσία</th>
				</tr>
				</tfoot>
				<tbody>
					<?php 
					include 'database2.php';
					mssql_select_db('CSTIMETABLE')
					or die('Could not select a database.');
					
					$sql = "SELECT evID, dayofWeek, convert(date, evstart)as res_date,CONVERT(VARCHAR(5),evstart,108) as evstart, CONVERT(VARCHAR(5),evend,108) as evend,subject, UNIEvents.evTypeID, evtypedesc, wkpattern, Locations as locations, siName  from UNIEvents inner join UNIEventType on UNIEvents.evTypeID = UNIEventType.evtypeID
					inner join UNILocation on UNIEvents.Locations = UNILocation.loName
					inner join UNISite on UNILocation.loSiteID = UNISite.siID where evstart like '%2017%' and evID < 387636 order by evID";
					
					$result = mssql_query($sql) 
					or die('A error occured: ' . mysql_error());
					
					while ($Row = mssql_fetch_assoc($result)) {
					
						//$evID = $Row['evID'];
						$mera = $Row['dayofWeek'];
						/*$res_date = $Row['res_date'];
						$evstart = $Row['evstart'];
						$evend = $Row['evend'];
						$subject = $Row['subject'];
						$evtypedesc = $Row['evtypedesc'];
						$locations = $Row['locations'];
						
						//$locations = iconv("ISO-8859-7","UTF-8",$Row['locations']);
						$siName = $Row['siName'];*/
						
						
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
						
						echo '<td>'. $Row['res_date'] . '</td>';  
						echo '<td>'. $day . '</td>';
						echo '<td>'. $Row['evstart'] . '</td>';
						echo '<td>'. $Row['evend'] . '</td>';
						echo '<td>'. $Row['subject'] . '</td>';
						echo '<td>'. $Row['evtypedesc'] . '</td>';
						echo '<td>'. $Row['locations'] . '</td>';
						echo '<td>'. $Row['siName'] . '</td>';
						echo '</tr>';
					}
					mssql_close($link);
					?>
				</tbody>
			</table>
    	</div>
    </div> <!-- /container -->
		<?php
		//include('footer.php');
	?>
	<div class="container">
	<div class="row">
		
		
	</div>
	</div>

</body>
</html>