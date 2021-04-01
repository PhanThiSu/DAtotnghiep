$(document).ready(function () {
  $('.box').on('click','.dayweek', function (e) {
    e.preventDefault();
    var url 	= $(this).attr('href');
    if($(this).attr('type')=='button')
    	var field 	= {'date': $(this).attr('alt')};
    else
    	var field 	= {'week': $(this).attr('alt')};
    util.post(url, field);
  });
});