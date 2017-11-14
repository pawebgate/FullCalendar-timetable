<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<?php
	$first = $_POST['datepicker'];
	$locations = $_POST['locations'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link href="../img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Πρόγραμμα Ημέρας βάση Αίθουσας</title>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<link rel="stylesheet" href="css/dynamic.css">
	
	<script>
	$(document).ready(function() {
    	$('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
					});
				});
			}
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
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();

		} );
	</script>
	
</head>

<body>

    <div class="container">
		<div class="row">
			<a href="javascript:decreaseFontSize();"><img src="img/decrease.png" width="20" height="20"></a>
			<a href="javascript:increaseFontSize();"><img src="img/increase.png" width="20" height="20"></a>
		</div>

    		<div class="row">
    			<h3>Πρόγραμμα Ημέρας βάση Αίθουσας</h3>
    		</div>
			<div class="row">
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
						<th>Τμήμα</th>
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
						<th>Τμήμα</th>
						<th>Αίθουσα</th>
						<th>Τοποθεσία</th>
					</tr>
					</tfoot>
					<tbody>
					<?php 
					include 'database.php';
					$pdo = Database::connect();
					
						$sql = "select dayofWeek, res_date, evstart as start, evend as end, subject, name, evtypedesc, locations, siName from events where res_date = '$first' and locations = $locations";
						
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
						echo '<td>'. $row['name'] . '</td>';
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