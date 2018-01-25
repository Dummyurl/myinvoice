$(document).ready(function () {


    $('#RecordDelete').on('click', function () {
        var id = $("#record_id").val();
        $.ajax({
            url: site_url + "delete-log",
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
});

