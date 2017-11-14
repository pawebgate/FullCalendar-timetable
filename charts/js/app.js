$(document).ready(function(){
	$.ajax({
		url:"yliko.php",
		method: "GET",
		success: function(happy1){
			console.log(happy1);
			var material=[];
			var score1=[];
			for(var j in happy1){
			    material.push(happy1[j].yliko);
			    score1.push(happy1[j].plithos);
			}
			var chartdata2 = {
			    labels: material,
			    datasets : [
			        {
			            label: "Αριθμός Χρήσεων",
			            	
			            borderColor: 'rgba(200,200,200,0.75)',
			            hoverBackgroundColor: 'rgba(200,200,200,1)',
			            hoverBorderColor: '#FFCE56',
			            data: score1,
				    backgroundColor: ["#778899","#808080","#4169E1","#556B2F","#B22222","#8B008B","#FF6347"],
			        }
			    ]
			};
            var ctx2 = $("#mycanvas1");
            ctx2.globalAlpha = 0.4;
			var barGraph2 = new Chart(ctx2, {
			    type: 'bar',
			    data: chartdata2,
			    options: {
					scales: {
					  xAxes: [{
						ticks: {
						  autoSkip: false,
						  maxRotation: 90,
						  minRotation: 90
						}
					  }]
					}
				}
			});
		},
		error: function(happy1){
			console.log(happy1);
		}
	});
});