$(document).ready(function () {
    $("#AccountantForm").validate({
        rules: {
            Firstname: {
                required: true
            },
            Lastname: {
                required: true
            },
            Phone: {
                minlength: 10,
                maxlength: 14,
                required: true
            },
            Email: {
                required: true,
                email: true
            },
            Password: {
                minlength: 6,
                required: true,
            },
        },
        messages: {
            Email: {
                required: "Please enter your email"
            },
            Firstname: {
                required: "Please enter your Firstname"
            },
            Lastname: {
                required: "Please enter your Lastname"
            },
            Phone: {
                required: "Please enter your Phone Number",
                maxlength: "Please enter Correct Phone Number",
                minlength: "Please enter Correct Phone Number"
            }
        }
    });
    
    $('#RecordDelete').on('click', function () {
        var id = $("#record_id").val();
        $.ajax({
            url: site_url + "accountant/delete_accountant",
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

    $("#AccountantForm").submit(function () {
        if ($("#AccountantForm").valid()) {
            $('#loadingmessage').show();
        }
    });
    $('#ConfirmDelete').on('click', function () {
        var status_value = $("#status_value").val();
        var old_status = $.trim($("#old_status").val());
        var id = $("#user_id").val();
        $.ajax({
            url: site_url + "accountant/update_status",
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
});
jQuery(function ($) {
    $("#Phone").mask("(999) 999-9999");
});

$('#profile').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#profile_preview").attr("src", e.target.result);

    }
    reader.readAsDataURL(this.files[0]);
});