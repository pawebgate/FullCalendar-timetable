<?php
header('Content-Type: text/html; charset=iso-8859-7');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="http://10.10.1.81/panagiotis/timetable/img/pic.png" />
	
	<title>Κατάλογος αιθουσών με λειτουργικότητα</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<!--script src="js/datatables.js"></script-->
	
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

	


</head>

<body>

	<div class="container">
		<div class="row">
			<a href="javascript:decreaseFontSize();"><img src="img/decrease.png" width="20" height="20"></a>
			<a href="javascript:increaseFontSize();"><img src="img/increase.png" width="20" height="20"></a>
		</div>
		<div class="row">
			<h3>Κατάλογος αιθουσών με λειτουργικότητα</h3>
		</div>
		<div class="row">	
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
				</tr>
				</tfoot>
				<tbody>
					<?php 
					include 'database.php';
					$pdo = Database::connect();
					//$sql = "select * from schedule";
					$sql = "select distinct locations, capacity, capacity2, micro, blackboard, projector, video, siName from events";
					//schedule is a view
					foreach ($pdo->query($sql) as $row) {
						
						echo '<tr>';
						echo '<td>'. $row['locations'] . '</td>';
						echo '<td>'. $row['capacity'] . '</td>';
						echo '<td>'. $row['capacity2'] . '</td>';
						echo '<td>'. $row['micro'] . '</td>';
						echo '<td>'. $row['blackboard'] . '</td>';
						echo '<td>'. $row['projector'] . '</td>';
						echo '<td>'. $row['video'] . '</td>';
						echo '<td>'. $row['siName'] . '</td>';
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
    	</div>
    </div> 
</body>
</html>