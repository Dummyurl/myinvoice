// User Registration Form

$(document).ready(function () {
    $.validator.addMethod("passwordRule", function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/.test(value);
    }, "Please enter valid password.");

    $("#login_form").validate({
        rules: {
            Firstname: {
                required: true,
            },
            Lastname: {
                required: true
            },
            Email: {
                required: true,
                email: true
            },
            Phone: {
                minlength: 10,
                maxlength: 14,
                required: true,
            },
            Password: {
                required: true,
                minlength: 8,
                maxlength: 15,
                passwordRule: true
            },
            Cpassword: {
                required: true,
                equalTo: "#Password"
            },
        },
        messages: {
            Firstname: {
                required: "Please enter your firstname",
            },
            Lastname: {
                required: "Please enter your lastname",
            },
            Email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },
            Phone: {
                required: "Please enter your phone number",
                minlength: "Please enter minimum 10 digit of number",
                maxlength: "Please enter maximum 14 digit of number"
            },
            Password: {
                required: "Please enter a password",
                minlength: "Please enter minimum 8 characters",
                maxlength: "Please enter maximum 15 characters"
            },
            Cpassword: {
                required: "Please enter a confirm password",
                equalTo: "Password and confirm password must be same."
            },
        },
        errorPlacement: function (error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
    });

});