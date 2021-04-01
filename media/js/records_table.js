$(document).ready(function () {
	(function($) {
		var numAllBtn = 0;
		var numBtnActive;
		var listChecked = [];
		var strFil = "";
		var ctl = $("table.dataTableFonend").attr("controller");

		function delRecord(id, act) {
			urlDele = rootUrl+ctl+"/"+act+"/"+ id;
			$.ajax({
				url: urlDele,
				success: function (data) {
					if(data != 'error'){
						$('#row'+id).remove();
					}
				}
			})
		}

		function trashRecord(id) { 
			urlTrash = rootUrl+ctl+"/trash/id="+ id;
			$.ajax({
				url: urlTrash,
				success: function (data) {
					if(data != 'error') {
						$('#row'+id).remove();
					}
				}
			});
		}

		//Action Btn
		$('tbody.records').on('click','td.btn-act button.trash-record', function () {
			var isTrash = confirm("Are you sure to move to trash this record?");
			if(isTrash){
				idAct = $(this).attr('alt');
				delRecord(idAct, "trash");
				//trashRecord(idAct);
			}
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