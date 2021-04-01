$(document).ready(function() {
	$(".select2").select2();

	var colors = [
		"Red",
		"Orange",
		"Green",
		"Gold",
		"Pink",
		"Violet",
		"Pink",
		"Purple",
		"Blue",
		"Yellow",
		"Chocolate",
		"Tomato",
		"Aqua",
		"Brown",
		"Grey",		// Gray 
		"Navy",
		"Olive",
		"Sienna",
		"Silver",
		"Black",
	];

	var noData = data.length;
	var bgcolor = [];
	for(i=0; i<noData; i++) {
		bgcolor.push(colors[i]);
	}


	datac = {
	    datasets: [{
	        data: data,
	        backgroundColor: bgcolor
	    }],
	    labels: labels,
	};
	var ctx = document.getElementById("myChart");
	var myPieChart = new Chart(ctx,{
	    type: 'pie',
	    data: datac
	});
});