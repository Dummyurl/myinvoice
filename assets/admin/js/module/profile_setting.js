$(document).ready(function () {
    $("#profile_save_form").validate({
        rules: {
            Firstname: {
                required: true,
            },
            Lastname: {
                required: true
            },
            Phone: {
                minlength: 10,
                maxlength: 14,
                required: true,
            },
        },
    });
    $("#profile_save_form").submit(function () {
        if ($("#profile_save_form").valid()) {
            $('#loadingmessage').show();
        }
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_preview')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery(function ($) {
    $("#Phone").mask("(999) 999-9999");
});
$(document).ready(function () {
    $('#Pro_img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#profile_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
});