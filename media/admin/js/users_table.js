$(document).ready(function () {
	if(getDisable)
		$('.statusCheckbox').prop('indeterminate', true);

	$('.statusCheckbox').checkboxX({threeState: true, allowThreeValOnInit:true});

	$('.statusCheckbox').on('change', function() {
	    var status = $('.statusCheckbox').val();
	    var url = rootUrl+ 'admin/' + $('.dataTable').attr('controller');
	    if(status==="")
	   		url += '/index/status=0';
	   	else if(status==="1")
	   		url += '/index/status='+status;

	    window.location.replace(url);
	});
});