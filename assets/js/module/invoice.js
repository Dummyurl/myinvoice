$(document).ready(function (e) {
    $("#ProvidersList").DataTable({
        "searching": true
    });
});

function SendInvoicePopup($this) {
    $("#SendInvoiceForm")[0].reset();
    var url = $.trim($($this).attr("data-url"));
    var base_url = $.trim($($this).attr("data-base_url"));
    if (url != "") {
        $("#invoice_url").val(base_url);
        $("#invoice_path").attr("src", url);
        $('#sendinvoice').modal("show");
    } else {
        bootbox.alert("Invoice not found.");
        return false;
    }
}

function save_button() {
    var SendInvoiceForm = $("#SendInvoiceForm").valid();
    if (SendInvoiceForm) {
        $('#loadingmessage').show();
        $("#SendInvoiceForm").submit();
    }
}