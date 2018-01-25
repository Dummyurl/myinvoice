
 $(document).ready(function () {
   
    $("#wm-order").submit(function () {
        if ($("#wm-order").valid()) {
            $('#loadingmessage').show();
        }
    });
});


