$(document).ready(function () {
    jQuery.validator.addMethod("ckeditor_required", function (value, element) {
        var editorId = $(element).attr('id');
        var messageLength = CKEDITOR.instances[editorId].getData().replace(/<[^>]*>/gi, '').length;
        if (messageLength > 0) {
            return true;
        } else {
            return false;
        }
    }, "Please enter page description");
    $("#CmsForm").validate({
        ignore: [],
        rules: {
            Status: {
                required: true,
            },
            PageSlug: {
                required: true,
            },
            PageName: {
                required: true,
            },
            PageDescription: {
                ckeditor_required: true,
            }
        },
        messages: {
            Status: {
                required: "Please select status"
            },
            PageSlug: {
                required: "Please enter slug"
            },
            PageName: {
                required: "Please enter page name"
            }
        }

    });

    $('#RecordDelete').on('click', function () {
        var id = $("#record_id").val();
        $.ajax({
            url: site_url + "cms/delete_cms",
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


    $("#CmsForm").submit(function (e) {
        if ($("#CmsForm").valid()) {
            $('#loadingmessage').show();
        } else {
            e.preventDefault();
        }

    });
});
$('#ConfirmDelete').on('click', function () {
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    $.ajax({
        url: site_url + "cms/cms_update_status",
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