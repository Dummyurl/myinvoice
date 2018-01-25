$(document).ready(function () {
    $("#Backend_category").validate({
        rules: {
            title: {
                required: true,
            }, price: {
                required: true,
                number:true
            },
        },
        messages: {
            title: {
                required: "Please enter Backend Category Name"
            },
            price: {
                required: "Please enter Backend Category Price"
            },
        }

    });

    $('#RecordDelete').on('click', function () {
        var id = $("#record_id").val();
        $.ajax({
            url: site_url + "delete-backend-pcategory",
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
    $('#profile').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#profile_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });

    $("#Backend_category").submit(function () {
        if ($("#Backend_category").valid()) {
            $('#loadingmessage').show();
        }
    });
});
$('#ConfirmDelete').on('click', function () {
   
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "backend-pcategory-status",
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
$('#image').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#profile_preview").attr("src", e.target.result);

    }
    reader.readAsDataURL(this.files[0]);
});


                                