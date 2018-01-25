$(document).ready(function () {
    $("#BackgroundForm").validate({
        ignore: [],
        rules: {
            Status: {
                required: true,
            },
            Slug: {
                required: true,
            }
        },
        messages: {
            Image: {
                required: "Please select image"
            },
            Status: {
                required: "Please select status"
            },
            Slug: {
                required: "Please enter slug"
            }
        }

    });
    $("#BackgroundForm").submit(function (e) {
        var img = $("input[name=hidden_image]").val();
        if (img != '') {
            $("#Image").removeAttr("required");
        } else {
            $("#Image").attr('required', true);
        }
        if ($("#BackgroundForm").valid()) {
            $('#loadingmessage').show();
        } else {
            e.preventDefault();
        }

    });
});
$(document).ready(function () {
    $('#Image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#profile_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
});