$(document).ready(function () {
  $('#tbody-reports').on('click','.view-user-times', function (e) {
    e.preventDefault();
    var url 	= $(this).attr('href');
    var field 	= {'week': $('#week').val()};
    util.post(url, field);
  });
});