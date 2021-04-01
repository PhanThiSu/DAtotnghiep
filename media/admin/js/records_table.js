$(document).ready(function () {
	(function($) {
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";
		var ctl = $("table.dataTable").attr("controller");

		//Action Btn
		$('tbody.records').on('click','td.btn-act button.trash-record', function () {
			var isTrash = confirm("Are you sure to move to trash this record?");
			if(isTrash){
				idAct = $(this).attr('alt');
				delRecord(idAct, "trash");
				//trashRecord(idAct);
			}
		});

		// click status
		$('tbody.records input.change-status').change(function() {
			idAct = $(this).attr('alt');
			idAct = idAct.split('&');
			changeStatus(idAct[0], "trash",idAct[1]);
		});

		$('tbody.records').on('click','td.btn-act button.del-record', function () {
			var isDel = confirm("Are you sure to delete this record?");
			if(isDel){
				idAct = $(this).attr('alt');
				delRecord(idAct, 'del');
			}
		});

		$('table.dataTable').on('click', '.checkAll input', function () {
			if($(this).prop('checked')) {
				listChecked = [];
				$('.checkboxRecord input').each(function() {
					listChecked.push($(this).attr('alt'));
					$(this).prop('checked', true);
				});
				$('.checkAll input').prop('checked', true);
			} else {
				$('.checkboxRecord input').each(function() {
					listChecked = [];
					$(this).prop('checked', false);
				});
				$('.checkAll input').prop('checked', false);
			}
		});

		//Check to delete
		$('table.dataTable').on('click', '.checkboxRecord input', function () {
			var idCheckBox = $(this).attr('alt');
			if($(this).prop('checked')) {
				listChecked.push(idCheckBox);
			} else {
				listChecked.splice($.inArray(idCheckBox, listChecked), 1);
				$('.checkAll input').prop('checked', false);
			}
		});

		//Click To Delete Record
		$('#trash-records').on('click', function () {
			if(listChecked.length > 0) {
				var isDel = confirm("Are you sure to move those records to trash!");
				if(isDel){
					var ids = listChecked.toString(); 
					urlDel = rootUrl+"admin/"+ctl+"/trashmany/ids="+ ids;
					$.ajax({
						url: urlDel,
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
		});

		//Click To Delete Record
		$('#delete-records').on('click', function () {
			if(listChecked.length > 0) {
				var isDel = confirm("Are you sure delete those records!");
				if(isDel){
					var ids = listChecked.toString(); 
					urlDel = rootUrl+"admin/"+ctl+"/delmany/ids="+ ids;
					$.ajax({
						url: urlDel,
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
		});

		function delRecord(id, act) {
			urlDele = rootUrl+"admin/"+ctl+"/"+act+"/"+ id;
			$.ajax({
				url: urlDele,
				success: function (data) {
					if(data != 'error'){
						$('#row'+id).remove();
					}
				}
			})
		}

		function trashRecord(id, act) { 
			urlTrash = rootUrl+"admin/"+ctl+"/trash/"+ id;
			$.ajax({
				url: urlTrash,
				success: function (data) {
					if(data != 'error') {
						$('#row'+id).remove();
					}
				}
			});
		}

		function changeStatus(id, act, status) { 
			urlTrash = rootUrl+"admin/"+ctl+"/changestatus/"+ id;
			$.ajax({
				url: urlTrash,
				type: 'POST',
				data: {status: status},
				success: function (data) {
					if(data != 'error') {
						
					}
				}
			});
		}
		//Table Filter
		$('#table_filter input').on('keyup', function (e) {
			if(e.which == 13){
				strFil = $(this).val().trim();
			} 
		})
		$('#submit-search').off('click').on('click', function () {
			
		});
	})(jQuery);
});

