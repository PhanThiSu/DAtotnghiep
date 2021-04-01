$(document).ready(function() {
    var frm = $('#resetform');
    $(".btn-primary").click(function(){
    $(".error").hide();
    var hasError = false;
    var email = $("#email").val();
    var pass = $("#password").val();
    var newpass = $("#newpassword").val();
    var checkVal = $("#repeatnewpassword").val();
    if (email == '') {
         $("#email").after('<span class="error">Please enter a email.</span>');
    } else if (pass == '') {
         $("#password").after('<span class="error">Please enter a password.</span>');
        hasError = true;
    } else if (newpass == '') {
        $("#newpassword").after('<span class="error">Please enter a newpassword.</span>');
        hasError = true;
    } else if (checkVal == '') {
        $("#repeatnewpassword").after('<span class="error">Please re-enter your password.</span>');
        hasError = true;
    } else if (newpass != checkVal ) {
        $("#repeatnewpassword").after('<span class="error">Passwords do not match.</span>');
        hasError = true;
    }

    if(hasError == true) {return false;}

    if(hasError == false) {
            $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: {newpass:newpass},
            success: function(){}
            });
        };
    });

    // changepassword

    
     // Action Btn
    $('#tbody-adminReport').on('click','.ctn-admin-report #adminReport button.searchDate-report', function () {
        console.log('idAct');
        var urlDele = rootUrl +"reports/adminViewsReport";
        $.ajax({
            url: urlDele,

            success: function (data) {
                if(data != 'error'){
                    $('#viewSearchDate').html(data);
                }
            }
        })
    })

});