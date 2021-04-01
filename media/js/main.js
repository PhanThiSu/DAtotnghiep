var util = {};
util.post = function(url, fields) {
    var $form = $('<form>', {
        action: url,
        method: 'post'
    });
    $.each(fields, function(key, val) {
         $('<input>').attr({
             type: "hidden",
             name: key,
             value: val
         }).appendTo($form);
    });
    $form.appendTo('body').submit();
}

function converDate(d) {
  var dar = d.toLocaleDateString().split('/');
  return dar[2]+"-"+((dar[0]<10)?"0":"")+dar[0]+"-"+((dar[1]<10)?"0":"")+dar[1];
}
