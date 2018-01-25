$(document).ready(function () {


    $("#wizard").steps();
    $("#save_product_form").steps({
        bodyTag: "fieldset",
        onStepChanging: function (event, currentIndex, newIndex)
        {

            $(".demo").minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                format: $(this).attr('data-format') || 'hex',
                keywords: $(this).attr('data-keywords') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                change: function (value, opacity) {
                    if (!value)
                        return;
                    if (opacity)
                        value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

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

            var error = 0;
            if (currentIndex == 1) {
                $('.colorcode').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (slug == "" || (banner_img == "" && banner_img1 == "") || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.demo').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (color == "" || (banner_img == "" && banner_img1 == "") || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.c_banner_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (slug == "" || color == "" || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.c_color_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        if (slug == "" || (banner_img == "" && banner_img1 == "") || color == "") {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_title').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || (fimage == "" && fimage1 == "") || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_desc').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (ftitle == "" || (fimage == "" && fimage1 == "") || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || ftitle == "" || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_banner_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || ftitle == "" || (fimage == "" && fimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
            }
            if (currentIndex == 2) {
                $('.Description_Title').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if ((desc_img == "" && desc_img1 == "") || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_img').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if (desc_title == "" || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_detail').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        if (desc_title == "" || (desc_img == "" && desc_img1 == "")) {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });

            }
            if (error == 1) {
                return false;
            }
            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            var error = 0;
            if (currentIndex == 1) {
                $('.colorcode').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (slug == "" || (banner_img == "" && banner_img1 == "") || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.demo').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (color == "" || (banner_img == "" && banner_img1 == "") || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.c_banner_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        var color_img = $(this).parents(".color-data").find(".c_color_img").val();
                        var color_img1 = $(this).parents(".color-data").find(".c_color_img").parents(".form-group").find(".fileinput-filename").text();
                        if (slug == "" || color == "" || (color_img == "" && color_img1 == "")) {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.c_color_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var slug = $(this).parents(".color-data").find(".demo").val();
                        var banner_img = $(this).parents(".color-data").find(".c_banner_img").val();
                        var banner_img1 = $(this).parents(".color-data").find(".c_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        var color = $(this).parents(".color-data").find(".colorcode").val();
                        if (slug == "" || (banner_img == "" && banner_img1 == "") || color == "") {
                            $("#color-section").children('#color-message').show();
                            $("#color-section").children("#color-message").html("<h4 style='color:red;'>Please fill all detail in color section</h4>");
                            $("#color-section").children("#color-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_title').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || (fimage == "" && fimage1 == "") || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_desc').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (ftitle == "" || (fimage == "" && fimage1 == "") || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fbimage = $(this).parents(".flavor-data").find(".flavor_banner_img").val();
                        var fbimage1 = $(this).parents(".flavor-data").find(".flavor_banner_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || ftitle == "" || (fbimage == "" && fbimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.flavor_banner_img').each(function (e) {
                    var color_val = $(this).val();
                    if (color_val != '') {
                        var ftitle = $(this).parents(".flavor-data").find(".flavor_title").val();
                        var fdesc = $(this).parents(".flavor-data").find(".flavor-desc").val();
                        var fimage = $(this).parents(".flavor-data").find(".flavor_img").val();
                        var fimage1 = $(this).parents(".flavor-data").find(".flavor_img").parents(".form-group").find(".fileinput-filename").text();
                        if (fdesc == "" || ftitle == "" || (fimage == "" && fimage1 == "")) {
                            $("#flavor-section").children('#flavor-message').show();
                            $("#flavor-section").children("#flavor-message").html("<h4 style='color:red;'>Please fill all detail in flavor section</h4>");
                            $("#flavor-section").children("#flavor-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
            }
            if (currentIndex == 2) {
                $('.Description_Title').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if ((desc_img == "" && desc_img1 == "") || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_img').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if (desc_title == "" || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_detail').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        if (desc_title == "" || (desc_img == "" && desc_img1 == "")) {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
            }

            if (error == 1) {
                return false;
            }

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
            error = 0;
            if (currentIndex == 2) {
                $('.Description_Title').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if ((desc_img == "" && desc_img1 == "") || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_img').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_detail = $(this).parents(".section-data").find(".desc_detail").val();
                        if (desc_title == "" || desc_detail == "") {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
                $('.desc_detail').each(function (e) {
                    var desc = $(this).val();
                    if (desc != '') {
                        var desc_title = $(this).parents(".section-data").find(".Description_Title").val();
                        var desc_img = $(this).parents(".section-data").find(".desc_img").val();
                        var desc_img1 = $(this).parents(".section-data").find(".desc_img").parents(".form-group").find(".fileinput-filename").text();
                        if (desc_title == "" || (desc_img == "" && desc_img1 == "")) {
                            $("#main-section").children('#section-message').show();
                            $("#main-section").children("#section-message").html("<h4 style='color:red;'>Please fill all detail in description section</h4>");
                            $("#main-section").children("#section-message").slideUp(3000);
                            error = 1;
                        }
                    }
                });
            }
            if (error == 1) {
                return false;
            }

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
        ignore: [],
        rules: {
            Title: {
                required: true
            },
            Min_Qty: {
                required: true,
                number: true
            },
            Pro_Category: {
                required: true,
            },
            'Description_Title[]': {
                required: true
            },
            'Description[]': {
                required: true
            },
            Cost_Per_Case: {
                required: true,
                number: true
            },
            Cost_Per_PC: {
                required: true,
                number: true
            }
        },
        errorPlacement: function (error, element) {
            $(element).parent('div').addClass('has-error');
            error.insertAfter(element);
        }
    });


    $("#save_product_form").submit(function (e) {
        if ($("#save_product_form").valid()) {
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
        url: site_url + "product/update_status",
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
        url: site_url + "delete-product",
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
function change_banner_image(element) {
    $(element).parents(".color-data").find('input[name="Color_Banner_Image_hidden[]"]').remove();
//    alert("Fdf");
//  alert($(element).parents(".color-data").find('input[name="Color_Banner_Image_hidden[]"]').val());    
}
function change_color_image(element) {
    $(element).parents(".color-data").find('input[name="Color_Image_hideen[]"]').remove();
}
function change_description_image(element) {
    $(element).parents(".section-data").find('input[name="Description_Image_hideen[]"]').remove();
}
function change_flavor_image(element) {
    $(element).parents(".flavor-data").find('input[name="Flavor_Image_hidden[]"]').remove();
}
function change_flavor_banner_image(element) {
    $(element).parents(".flavor-data").find('input[name="Flavor_Banner_Image_hidden[]"]').remove();
}


$(document).ready(function () {

    $('#Pro_img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#Pro_img_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#Pro_banner_img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#Pro_banner_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });


    $('#Pro_feature_img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#Pro_feature_preview").attr("src", e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    });
});