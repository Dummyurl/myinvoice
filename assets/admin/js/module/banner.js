$(document).ready(function () {
    $("#BannerForm").validate({
        ignore: [],
        rules: {
            status: {
                required: true,
            }
        },
        messages: {
            image: {
                required: "Please select image"
            },
            status: {
                required: "Please select status"
            }
        }

    });


    $("#BannerForm").submit(function (e) {
        var img = $("input[name=hidden_image]").val();
        if (img != '') {
            $("#image").removeAttr("required");
        } else {
            $("#image").attr('required', true);
        }
        if ($("#BannerForm").valid()) {
            $('#loadingmessage').show();
        }else{
            e.preventDefault();
        }
    });
});
$('#ConfirmDelete').on('click', function () {
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "banner/banner_update_status",
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
$(document).ready(function () {
    $('#image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#profile_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
});
$('#RecordDelete').on('click', function () {
    var id = $("#record_id").val();
    $.ajax({
        url: site_url + "delete-banner",
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