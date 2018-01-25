$(document).ready(function () {
    $("#Faq").validate({
        rules: {
            title: {
                required: true,
            }, description: {
                required: true,
                
            },
        },
        messages: {
            title: {
                required: "Please enter Faq Name"
            },
           description: {
                required: "Please enter Faq Description"
            },
        }

    });

    $('#RecordDelete').on('click', function () {
        var id = $("#record_id").val();
        $.ajax({
            url: site_url + "delete-faq",
            type: "post",
            data: {id: id, token_id: csrf_token_name},
            beforeSend: function () {
                $('#loadingmessage').show();
            },
            success: function (data) {
                $('#loadingmessage').hide();
                if (data == true) {
                    $("#statusChange").modal("hide");
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            }
        });
    });
  

    $("#Faq").submit(function () {
        if ($("#Faq").valid()) {
            $('#loadingmessage').show();
        }
    });
});
$('#ConfirmDelete').on('click', function () {
   
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "faq-status",
        type: "post",
        data: {action: "update_status", status_value: status_value, id: id, old_status: old_status, token_id: csrf_token_name},
        beforeSend: function () {
            $('#loadingmessage').show();
        },
        success: function (data) {

            if (data == true) {
                $("#statusChange").modal("hide");
                window.location.reload();
            } else {
                window.location.reload();
            }
        }
    });
});


                                