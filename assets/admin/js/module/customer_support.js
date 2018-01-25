$(document).ready(function () {
    $("#CustomerSupport").validate({
        rules: {
            subject: {
                required: true,
            },
            message: {
                required: true,
            },
            
        },
        messages: {
            subject: {
                required: "Please enter your Subject"
            },
            message: {
                required: "Please enter your Message"
            },
           
        }

    });

  
    $("#CustomerSupport").submit(function () {
        if ($("#CustomerSupport").valid()) {
            $('#loadingmessage').show();
        }
    });
});
           