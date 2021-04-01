$(document).ready(function() {
  $(".select2").select2();
  $('.timepicker').timepicker({
    showMeridian: false,
    showInputs: false
  });

  $("#work_time, #time_start").change(function() {
    var time_start  = $("#time_start").val();
    var time_work   = $("#work_time").val();
    if(time_work != "") {
      var tsar        = time_start.split(":");
      var twar        = time_work.split(".");
      var tesghv = ((parseInt(tsar[0])+parseInt(twar[0])) < 24)? parseInt(tsar[0])+parseInt(twar[0]): parseInt(tsar[0])+parseInt(time_work)-24;
      var tesgmv = 0;
      if(typeof twar[1] !== 'undefined') {
        if((parseInt(tsar[1]) + (60*parseInt(twar[1]))/10) < 60)
          tesgmv = parseInt(tsar[1]) + (60*parseInt(twar[1])/10);
        else {
          tesgmv = parseInt(tsar[1]) + (60*parseInt(twar[1])/10) - 60;
          tesghv+= 1;
        }
      } else {
        tesgmv  = parseInt(tsar[1]);
      }
      var tesgv = tesghv+":"+tesgmv;
    } else  tesgv = time_start;
    $('#time_end').timepicker('setTime', tesgv);
  });

  // defaultTime
  $("#group_id").change(function() {
    if($(this).val() == 1) {
      $("#group_suggest_group").removeClass('hide');
    } else {
      $("#group_suggest_group").addClass('hide');
    }
  });

  $("#cb_group_suggest").change(function() {
      if($(this).is(":checked")) {
          $("#group_suggest").removeAttr('disabled');
      } else {
          $("#group_suggest").attr('disabled','disabled');
      }
  });

  // $('#group_suggest').blur(function(){
  //   var name = $(this).val();
  //   var urlUpdate = rootUrl+"reports/err";
  //   $.ajax({
	// 		url: urlUpdate,
	// 		type: 'POST',
	// 		data: {'group_name':name},
	// 		success: function (data) {
  //       $('#err_group_name').text(data);
  //     },
  //     error: function(){
  //     }
	// 	})
  // })
});