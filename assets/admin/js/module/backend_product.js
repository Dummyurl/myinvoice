$(document).ready(function () {
    $("#BackendProduct").validate({
        rules: {
            title: {
                required: true,
            },
            backend_category_id: {
                required: true
            },
            sku: {
                required: true
            },
            cost_per_pc: {
                required: true,
                number: true
            },
            cost_per_case: {
                required: true
            },
            min_qty: {
                required: true
            }
        }
    });
    $("#BackendProduct").submit(function () {
        if ($("#BackendProduct").valid()) {
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
        url: site_url + "update-backend-product-status",
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
        url: site_url + "delete-backend-product",
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
$('#image').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#profile_preview").attr("src", e.target.result);

    }
    reader.readAsDataURL(this.files[0]);
});