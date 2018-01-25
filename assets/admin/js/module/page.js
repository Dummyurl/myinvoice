$(document).ready(function () {
    $("#PageForm").validate({
        rules: {
            Pagename: {
                required: true,
            }
        },
        messages: {
            Pagename: {
                required: "Please enter Page name"
            },
        }

    });
    $("#PageForm").submit(function () {
        if ($("#PageForm").valid()) {
            $('#loadingmessage').show();
        }
    });
});
$('#ConfirmDelete').on('click', function () {
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "page/page_update_status",
        type: "post",
        data: {action: "update_status", status_value: status_value, id: id, old_status: old_status, token_id: csrf_token_name},
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
$('#RecordDelete').on('click', function () {
    var id = $("#record_id").val();
    $.ajax({
        url: site_url + "delete-page",
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