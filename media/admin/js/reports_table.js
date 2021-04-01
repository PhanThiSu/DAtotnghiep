$(document).ready(function () {
	$('.btn-toggle .btn').click(function() {
	    $('.btn-toggle .btn').removeClass('active btn-danger');  
	    $(this).removeClass('btn-default').addClass('active btn-danger');

    	var formType = $(this).html().toLowerCase();
    	$('.form-report').addClass('hide');
    	$('#form-report-'+formType).removeClass('hide');
	});
});