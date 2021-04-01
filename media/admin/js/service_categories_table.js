$(document).ready(function () {
	(function($) {
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";

		function delServiceCategory(id) {
			urlDele = rootUrl+"admin/service_categories/del/"+ id;
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
		$('#tbody-service_categories').off('click').on('click','td.btn-act button.dele-service_category', function () {
			var isDele = confirm("Are you sure to delete this record?");
			if(isDele){
				idAct = $(this).attr('alt');
				delServiceCategory(idAct);
			}
		})

		$('#table_service_categories').on('click', '.checkAll input', function () {
			if($(this).prop('checked')) {
				listChecked = [];
				$('.checkboxServiceCategory input').each(function() {
					listChecked.push($(this).attr('alt'));
					$(this).prop('checked', true);
				});
				$('.checkAll input').prop('checked', true);
			} else {
				$('.checkboxServiceCategory input').each(function() {
					listChecked = [];
					$(this).prop('checked', false);
				});
				$('.checkAll input').prop('checked', false);
			}
		})

		//Check to delete
		$('#table_service_categories').on('click', '.checkboxServiceCategory input', function () {
			var idCheckBox = $(this).attr('alt');
			if($(this).prop('checked')) {
				listChecked.push(idCheckBox);
			} else {
				listChecked.splice($.inArray(idCheckBox, listChecked), 1);
				$('.checkAll input').prop('checked', false);
			}
		})

		//Click To Delete ServiceCategory
		$('#delete-service_categories').off('click').on('click', function () {
			if(listChecked.length > 0) {
				var isDele = confirm("Are you sure!");
				if(isDele){
					var ids = listChecked.toString(); 
					urlDele = rootUrl+"admin/service_categories/delmany/ids="+ ids;
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
