$(document).ready(function () {
    $("#wizard").steps();
    $("#form").steps({
        bodyTag: "fieldset",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age").val()) < 18)
            {
                return false;
            }

            var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18)
            {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
        },
        onFinishing: function (event, currentIndex)
        {
            $("#btn_image").trigger("click");
            var form = $(this);

            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
            form.validate().settings.ignore = ":disabled";

            // Start validation; Prevent form submission if false
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            var form = $(this);

            // Submit form input
            form.submit();
        }
    }).validate({
        errorPlacement: function (error, element)
        {
            if (element.attr("name") == "type_of_business[]") {
                error.appendTo($('#type_of_business_validate'));
            } else {
                 element.after(error);
            }
           
        },
        rules: {
            first_name: {
                required: true
            },
            company_name: {
                required: true
            },
            address_one: {
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 14,
            },
            city: {
                required: true
            },
            zip: {
                required: true,
                number: true,
                minlength: 4,
                maxlength: 7
            },
            state: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            account_email: {
                email: true
            },
            tax_id: {
                required: true
            },
            'type_of_business[]': {
                required: true
            },
        },
        messages: {
            first_name: {
                required: "Please enter your First name"
            },
            company_name: {
                required: "Please enter your Company name"
            },
            address_one: {
                required: "Please enter Address one"
            },
            phone: {
                required: "Please enter your Phone Number",
                maxlength: "Please enter Correct Phone Number",
                minlength: "Please enter Correct Phone Number"
            },
            city: {
                required: "Please enter City"
            },
            zip: {
                required: "Please enter Zip number"
            },
            state: {
                required: "Please enter State"
            },
            email: {
                required: "Please enter Email",
                email: "Please enter valid Email"
            },
            account_email: {
                email: "Please enter valid Email"
            },
            tax_id: {
                required: "Please enter Tax id"
            },
            'type_of_business[]': {
                required: "Please select type of Business"
            },
        }
    });
    $("#form").submit(function () {
        if ($("#form").valid()) {
            $('#loadingmessage').show();
        }
    });
});

$(document).ready(function () {
    if ($("#other").is(':checked')) {
        $('#other_business').attr('required', true);
        $(".other_business_div").show();
    }
    $("#other").click(function () {
        if ($("#other").is(':checked')) {
            $('#other_business').attr('required', true);
            $(".other_business_div").show();
        } else {
            $('#other_business').removeAttr('required');
            $(".other_business_div").hide();
        }
    });
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
});
$('#ConfirmDelete').on('click', function () {
    var status_value = $("#status_value").val();
    var old_status = $.trim($("#old_status").val());
    var id = $("#user_id").val();
    var LID = $("#LoginID").val();
    $.ajax({
        url: site_url + "customer/update_status",
        type: "post",
        data: {action: "update_status", LID: LID, status_value: status_value, id: id, old_status: old_status, token_id: csrf_token_name},
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
    $("#form").submit(function () {
        if ($("#form").valid()) {
            $('#loadingmessage').show();
        }
    });
});
function check_number(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
jQuery(function ($) {
    $("#phone").mask("(999) 999-9999");
    $("#card_number").mask("9999-9999-9999-9999");
});
function DeleteRecordCustomer(value) {
    var id = $(value).attr("data-id");
    var lid = $(value).attr("data-lid");
    $("#record_id").val(id);
    $("#hidden_id").val(lid);
    $("#delete-record-customer").find(".modal-body").children("p").html("Do you really want to Delete?");
}
$('#RecordDelete').on('click', function () {
    var id = $("#record_id").val();
    var LID = $("#hidden_id").val();
    $.ajax({
        url: site_url + "delete-customer",
        type: "post",
        data: {id: id, LID: LID, token_id: csrf_token_name},
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