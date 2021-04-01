$(document).ready(function () {
    var ctl = $("table.dataTable").attr("controller");

    $('#checkboxPayedTop').change(function () {
        settings_id = $(this).attr('alt');
        if (this.checked) {
            var returnVal = confirm("Have you confirm paid salary?");
            if (returnVal) {
                url = rootUrl + "admin/" + ctl + "/updateAllStatus";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        status: 1,
                        settings_id: settings_id
                    },
                    success: function (res) {
                        res = JSON.parse(res);
                        console.log(res);

                        if (res.status == 1) {
                            location.replace(rootUrl + 'admin/'+ ctl + '/view?month=' + month + '&year=' + year)
                        } else {
                            alert(res.message);
                        }
                    }
                })
            }
            $(this).prop("checked", returnVal);
        } else {
            url = rootUrl + "admin/" + ctl + "/updateAllStatus";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    status: 0,
                    settings_id: settings_id
                },
                success: function (res) {
                    res = JSON.parse(res);
                    if (res.status == 1) {
                        location.replace(rootUrl + 'admin/'+ ctl + '/view?month=' + month + '&year=' + year)
                    } else {
                        alert(res.message);
                    }
                }
            })
        }
    });
    // click status
    $('tbody.records input.change-status').change(function () {
        idAct = $(this).attr('alt');
        idAct = idAct.split('&');
        changeStatus(idAct[0], "trash", idAct[1]);
    });

    function changeStatus(id, act, status) { 
        urlTrash = rootUrl+"admin/"+ctl+"/changestatus/"+ id;
        $.ajax({
            url: urlTrash,
            type: 'POST',
            data: {status: status},
            success: function (data) {
                if(data != 'error') {
                    
                }
            }
        });
    }
});