$(document).ready(function () {
	var ctl = $("table.dataTable").attr("controller");
	(function($) {
		$('.radio-wrapper input').change(function(event) {
			var id = $(this).parent("div.radio-wrapper").attr('recordid');
			var status = $(this).hasClass('yes_radio')? 1: 2; 
			var urlUpdate = rootUrl+"admin/"+ctl+"/updateStatus/"+ id;
			$.ajax({
				url: urlUpdate,
				type: 'POST',
				data: {status:status,idrq:id},
				success: function (data) {
					if(data == 'error')

						$('#modal-danger').modal();
					else 
						console.log(data);
						$('#modal-success').modal();
				}
			})
		});
	})(jQuery);
	
	$('.btn-toggle').click(function() {
	    $(this).find('.btn').toggleClass('active');  
	    
	    if ($(this).find('.btn-danger').length>0) {
	    	$('.form-request').removeClass('hide');
	    	if($(this).find('.btn-danger').html() == "Month") {
	    		$('#form-request-month').addClass('hide');
	    	} else if($(this).find('.btn-danger').html() == "Week") {
	    		$('#form-request-week').addClass('hide');
	    	}

	    	$(this).find('.btn').toggleClass('btn-danger');
	    }
	    /*
	    if ($(this).find('.btn-primary').length>0) {
	        $(this).find('.btn').toggleClass('btn-primary');
	    }
	    if ($(this).find('.btn-success').length>0) {
	    	$(this).find('.btn').toggleClass('btn-success');
	    }
	    if ($(this).find('.btn-info').length>0) {
	    	$(this).find('.btn').toggleClass('btn-info');
	    }
	    */
	    $(this).find('.btn').toggleClass('btn-default');

	});

});