$(document).ready(function () {
  $('.box').on('click','.month', function (e) {
    e.preventDefault();
    var url 	= $(this).attr('href');
    var field 	= {'month': $(this).attr('alt')};
    util.post(url, field);
  });
});