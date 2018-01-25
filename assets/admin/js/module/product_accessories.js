$(document).ready(function () {
    $("#ProductCategory").validate({
        rules: {
            title: {
                required: true,
            },
            image: {
                required: true,
            }            
        }
    });
    $("#ProductAccessories").submit(function () {
        if ($("#ProductAccessories").valid()) {
            $('#loadingmessage').show();
        }
    });
});

$(document).ready(function () {
    $("#EditProductAccessories").validate({
        rules: {
            title: {
                required: true,
            }
        }
    });
    $("#EditProductAccessories").submit(function () {
        if ($("#EditProductAccessories").valid()) {
            $('#loadingmessage').show();
        }
    });
});



$('#ConfirmDelete').on('click', function () {
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "accessories/update-accessories-status",
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
        url: site_url + "delete-product-accessories",
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