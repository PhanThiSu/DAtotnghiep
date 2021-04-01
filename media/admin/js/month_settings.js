$(document).ready(function(){ 
    const $tempTime = $("#time_required").val();
    const $conOff = $('#day_off option:selected').val()

    $('#day_off').on('change', function() {
        var $day_off = parseInt(this.value);
        $time_required = parseInt($tempTime) - ($day_off - parseInt($conOff))*8;
        $("#time_required").val($time_required);
    });
    $('.calculate_salary').on('click',"button", function(e) {
        var isConfirm = confirm("Can you want to calculate salary of this month?");
        if(!isConfirm){
            e.preventDefault();
        }
        // if(isConfirm){
        //     $("#form-calculate").submit();
        //     $("#btn_submit").click();
        // }
    });
  });