$(document).ready(function () {
	(function($) {
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";

		function delService(id) {
			urlDele = rootUrl+"admin/services/del/"+ id;
			$.ajax({
				url: urlDele,
				success: function (data) {
					if(data != 'error'){
						$('#row'+id).remove();
						/*
						var isReload = confirm("Do you want reload this page?");
						if(isReload){
							location.reload();
						}
						*/
					}
				}
			})
		}

		//Action Btn
		$('#tbody-services').off('click').on('click','td.btn-act button.dele-service', function () {
			var isDele = confirm("Are you sure to delete this record?");
			if(isDele){
				idAct = $(this).attr('alt');
				delService(idAct);
			}
		})

		$('#table_services').on('click', '.checkAll input', function () {
			if($(this).prop('checked')) {
				listChecked = [];
				$('.checkboxService input').each(function() {
					listChecked.push($(this).attr('alt'));
					$(this).prop('checked', true);
				});
				$('.checkAll input').prop('checked', true);
			} else {
				$('.checkboxService input').each(function() {
					listChecked = [];
					$(this).prop('checked', false);
				});
				$('.checkAll input').prop('checked', false);
			}
		})

		//Check to delete
		$('#table_services').on('click', '.checkboxService input', function () {
			var idCheckBox = $(this).attr('alt');
			if($(this).prop('checked')) {
				listChecked.push(idCheckBox);
			} else {
				listChecked.splice($.inArray(idCheckBox, listChecked), 1);
				$('.checkAll input').prop('checked', false);
			}
		})

		//Click To Delete Service
		$('#delete-services').off('click').on('click', function () {
			if(listChecked.length > 0) {
				var isDele = confirm("Are you sure!");
				if(isDele){
					var ids = listChecked.toString(); 
					urlDele = rootUrl+"admin/services/delmany/ids="+ ids;
					$.ajax({
						url: urlDele,
						success: function (data) {
							if(data != 'error') {
								$.each(listChecked, function (k, v) {
									$('#row'+v).remove();
								});
								listChecked = [];
								/*
								var isReload = confirm("Do you want reload this page?");
								if(isReload){
									location.reload();
								}
								*/
							}
						}
					})
				}
			} else {
				alert("Nobody to delete!");
			}
		})

		//Table Filter
		$('#table_filter input').on('keyup', function (e) {
			if(e.which == 13){
				strFil = $(this).val().trim();
			} 
		})
		$('#submit-search').off('click').on('click', function () {
			
		})
	})(jQuery);
	
});
