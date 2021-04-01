
  $( document ).ready(function() {
    let day = new Date()
    let checkTimeOut = false

    // check radio
    let checkRadio = $('input[type=radio][name=exampleRadios]');
    let radio = 0;
    var checkJob =false;

    checkRadio.change(function() {
      
        if (this.value == '0') {
            $('.existingJob').hide().prop("disableb", true);
            $('#id_report').prop('disabled', true)
            $('#job').prop('disabled',false);
            $('.newJob').css("display", "unset");
            radio=0;
        }
        else if (this.value == '1') {
            $('.newJob').hide();
            $('#id_report').prop('disabled', false)
            $('#job').prop('disabled',true);
            $('#job').val('')
            $('.existingJob').css("display", "unset");
            radio=1;
        }
    })


    // Click Log Time
    let checkGr = false;
    $('#group_id').change(function(){
        if($(this).val()!=""){
            checkGr = true;

            let urlAdd = rootUrl+"logtime/listJob";
            $.ajax({
                url: urlAdd,
                method: "POST",
                dataType: 'json',
                data:{'group_id':$(this).val()}
            }).always(function(data) {
                if ( data != null) {
                    $('.form-check-existing').css('display','unset');
                    $.each(data, function (i, item) {
                        $('#id_report').append($('<option>', { 
                            value: item.id,
                            text : item.job 
                        }));
                    });
                    if (checkJob) {
                        $('#id_report').val(data[0].id).change();
                    }
                }else{
                    $('.form-check-existing').css('display','none');
                    $("#id_report option[value!='']").each(function() {
                        $(this).remove();
                    });
                    $('.existingJob').hide().prop("disableb", true);
                    $('#id_report').prop('disabled', true)
                    $('#job').prop('disabled',false);
                    $('.newJob').css("display", "unset");
                    radio=0;
                }
            });  

        }
    })

    $('#startLogTime').click(function(){
        let id;
        if(checkGr){
            if(confirm("Do you want to start work now")){
                if(radio==0){ // add new report
                    let data = new FormData($('#formLogTime')[0]);
                    let urlAdd = rootUrl+"logtime/addAjax";
                    $(this).prop("disabled", true)
                    $('#stopLogTime').prop("disabled", false)
                    $.ajax({
                        url: urlAdd,
                        method: "POST",
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                    
                        data: data
                    }).always(function() {
                    // disabled 
                    $('form input').prop("disabled", true);
                    $('form textarea').prop("disabled", true);
                    $('form select').prop("disabled", true);
                    $('#exampleRadios1').prop({'checked':true,'disabled':false})
        
                    // show time
                    let time = new Date();
                    $('#countdown').html('');
                        $('#countdown').countup({
                            start: time,
                        });
            
                    });  
                }
                if(radio==1){ // update report
                    let data = new FormData($('#formLogTime')[0]);
                    let urlAdd = rootUrl+"logtime/updateAjax";
                    $(this).prop("disabled", true)
                    $('#stopLogTime').prop("disabled", false)
                    $.ajax({
                        url: urlAdd,
                        method: "POST",
                        processData: false,
                        contentType: false,
                    
                        dataType: 'json',
                        data: data
                    }).done(function(data) {
                        // disabled 
                        $('form input').prop("disabled", true);
                        $('form textarea').prop("disabled", true);
                        $('form select').prop("disabled", true);
                        $('#exampleRadios2').prop({'checked':true,'disabled':false})
                        data = parseFloat(data);
                        let time = new Date();
                        let h = parseInt(data);
                        let m = parseInt((data - h)*60);
                        let s = parseInt( ((data - h)*60 - m)*60);
                        time.setHours(time.getHours() - h);
                        time.setMinutes(time.getMinutes()-m)
                        time.setSeconds(time.getSeconds()-s)
                        // show time
                        $('#countdown').html('');
                        $('#countdown').countup({
                            start: time,
                        });
                    });
                }

            }
        }else{
            alert("Please, check group")
        }

        autoLoad($('#group_id').val());
        test()
    })

    function test(){
        console.log('aa')
        setInterval(()=>{
            day = new Date()
            console.log(day.getHours())
            console.log(day.getMinutes())
            if(day.getHours()==12 && day.getMinutes()==00 || day.getHours()==17 && day.getMinutes()==11 ){
                $('.modal-timeTracking').modal('show')
                checkTimeOut=true
                setTimeout(()=>{
                    if(checkTimeOut) $('.btn-popug-no').trigger('click')
                },60000)
            }
        },(0.6*60000))
    }

    $('.btn-popug-yes').click(function(){
        checkTimeOut=false
    })

    $('.btn-popug-no').click(function(){
        $(this).prop("disabled", true)
        $('#startLogTime').prop("disabled", false)
        let urlAdd = rootUrl+"logtime/updateAjax";
        $.ajax({
            url: urlAdd,
            method: "POST",
            processData: false,
            contentType: false,
            dataType: 'text',
        }).done(function(data) {
            $('form input').prop("disabled", false);
            $('form textarea').prop("disabled", false);
            $('form select').prop("disabled", false);
            $('#exampleRadios1').prop({'disabled':false})
            $('#exampleRadios2').prop({'disabled':false})
            location.reload();
        });
    })

    $('#stopLogTime').click(function(){
        if(confirm("Do you want stop work")){
            $(this).prop("disabled", true)
            $('#startLogTime').prop("disabled", false)
            let urlAdd = rootUrl+"logtime/updateAjax";
            $.ajax({
                url: urlAdd,
                method: "POST",
                processData: false,
                contentType: false,
                dataType: 'text',
            }).done(function(data) {
                $('form input').prop("disabled", false);
                $('form textarea').prop("disabled", false);
                $('form select').prop("disabled", false);
                $('#exampleRadios1').prop({'disabled':false})
                $('#exampleRadios2').prop({'disabled':false})
                location.reload();
            });
        }
    })

    //f5
    if(check_reportId!='null' ){
        let urlAdd = rootUrl+"logtime/requestLoad";
        $.ajax({
            url: urlAdd,
            method: "POST",
            dataType: 'json',
            data: {"id_report":check_reportId}
        }).done(function(data) {
            checkJob = true;
            $('form input').prop("disabled", true);
            $('form textarea').prop("disabled", true);
            $('form select').prop("disabled", true);
            $('#group_id').val(data[0].group_id).change();
            $('.newJob').hide();
            $('.existingJob').css("display", "unset");
            // $('#id_report').val(data[0].id).change();
            $('#exampleRadios2').prop({'checked':true,'disabled':false})
            $('#startLogTime').prop('disabled',true);
            $('#stopLogTime').prop('disabled',false);

            data = parseFloat(data[0].work_time);
            let time = new Date();
            let h = parseInt(data);
            let m = parseInt((data - h)*60);
            let s = parseInt( ((data - h)*60 - m)*60);
            time.setHours(time.getHours() - h);
            time.setMinutes(time.getMinutes()-m)
            time.setSeconds(time.getSeconds()-s)
            // show time
            $('#countdown').html('');
            $('#countdown').countup({
                start: time,
            });
        }).always(function(){
            autoLoad(check_reportId);
        });
    }
    let timeUpload = 6;
    function autoLoad(id_report){
        setInterval(() => {
            console.log('hour: '+day.getHours())
            console.log('hour: '+day.getMinutes())
            let urlAdd = rootUrl+"logtime/autoUpdateAjax";
            $.ajax({
                url: urlAdd,
                method: "POST",
                dataType: 'json',
                data: {"id_report":check_reportId}
            })
        }, (timeUpload*60000));
    }
});