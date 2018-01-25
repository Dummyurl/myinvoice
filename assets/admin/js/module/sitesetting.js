$(document).ready(function () {
    $("#wizard").steps();
    $("#site_setting_action").steps({
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
        rules: {
            company_phone1: {
                required: true
            },
            company_email1: {
                required: true
            },
            company_name: {
                required: true
            },
            company_address1: {
                required: true
            }
        },
        errorPlacement: function (error, element)
        {
            element.after(error);
        },
    });
    $("#site_setting_action").submit(function () {
        if ($("#site_setting_action").valid()) {
            $('#loadingmessage').show();
        }
    });
    $('#company_logo').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#company_logo_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
    $('#footer_image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#footer_image_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
    $('#description_image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#description_image_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
    $('#about_image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#about_image_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });


});