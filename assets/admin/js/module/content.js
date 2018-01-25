$(document).ready(function () {
    $.validator.addMethod("passwordRule", function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/.test(value);
    }, "Please enter valid password.");

    $("#change_password_form").validate({
        rules: {
            Oldpassword: {
                required: true
            },
            Password: {
                required: true,
                minlength: 6,
                maxlength: 15,
                passwordRule: true
            },
            Confirm_password: {
                required: true,
                equalTo: "#Password"
            }
        },
        messages: {
            Oldpassword: {
                required: "Please enter old password",
            },
            Password: {
                required: "Please enter password",
                minlength: "Please enter minimum 8 characters",
                maxlength: "Please enter maximum 15 characters"
            },
            Confirm_password: {
                required: "Please enter confirm password",
                equalTo: "Password and confirm password must be same."
            }
        }

    });

    $("#change_password_form").submit(function () {
        if ($("#change_password_form").valid()) {
            $('#loadingmessage').show();
        }
    });
});