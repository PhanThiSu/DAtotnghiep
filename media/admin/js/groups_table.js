$(document).ready(function () {
	(function($) {
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";

		function delGroup(id, act) {
			urlDele = rootUrl+"admin/groups/"+act+"/"+ id;
			$.ajax({
				url: urlDele,
				success: function (data) {
					if(data != 'error'){
						$('#row'+id).remove();
					}
				}
			})
		}

		//Action Btn
		$('#tbody-groups').on('click','td.btn-act button.trash-group', function () {
			var isTrash = confirm("Are you sure to delete this record?");
			if(isTrash){
				idAct = $(this).attr('alt');
				delGroup(idAct, "trash");
			}
		});

		$('#tbody-groups').on('click','td.btn-act button.del-group', function () {
			var isDel = confirm("Are you sure to delete this record?");
			if(isDel){
				idAct = $(this).attr('alt');
				delGroup(idAct, 'del');
			}
		});

		$('#table_groups').on('click', '.checkAll input', function () {
			if($(this).prop('checked')) {
				listChecked = [];
				$('.checkboxGroup input').each(function() {
					listChecked.push($(this).attr('alt'));
					$(this).prop('checked', true);
				});
				$('.checkAll input').prop('checked', true);
			} else {
				$('.checkboxGroup input').each(function() {
					listChecked = [];
					$(this).prop('checked', false);
				});
				$('.checkAll input').prop('checked', false);
			}
		});

		//Check to delete
		$('#table_groups').on('click', '.checkboxGroup input', function () {
			var idCheckBox = $(this).attr('alt');
			if($(this).prop('checked')) {
				listChecked.push(idCheckBox);
			} else {
				listChecked.splice($.inArray(idCheckBox, listChecked), 1);
				$('.checkAll input').prop('checked', false);
			}
		});

		//Click To Delete Group
		$('#trash-groups').on('click', function () {
			if(listChecked.length > 0) {
				var isDel = confirm("Are you sure!");
				if(isDel){
					var ids = listChecked.toString(); 
					urlDel = rootUrl+"admin/groups/trashmany/ids="+ ids;
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

		//Click To Delete Group
		$('#delete-groups').on('click', function () {
			if(listChecked.length > 0) {
				var isDel = confirm("Are you sure!");
				if(isDel){
					var ids = listChecked.toString(); 
					urlDel = rootUrl+"admin/groups/delmany/ids="+ ids;
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