$(document).ready(function (e) {
    $("#ProvidersList").DataTable({
        "searching": true
    });
});
function SendInvoicePopup($this) {
    $("#SendInvoiceForm")[0].reset();
    var url = $.trim($($this).attr("data-url"));
    var base_url = $.trim($($this).attr("data-base_url"));
    var c_name = $.trim($($this).attr("data-c_name"));
    var c_email = $.trim($($this).attr("data-c_email"));
    if (url != "") {
        $("#invoice_url").val(base_url);
        $("#Name").val(c_name);
        $("#Email").val(c_email);
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

$("#active-inactive-customer").confirm({
    title: 'Confirm!',
    content: 'Are you sure want to change the status?',
    type: 'red',
    typeAnimated: true,
    buttons: {
        cancel: function () {
        },
        confirm: {
            text: 'Ok',
            btnClass: 'btn-red',
            action: function () {
                var token = $("#active-inactive-customer").attr("data-token");
                var status = $("#active-inactive-customer").attr("status");
                $.ajax({
                    type: "GET",
                    url: site_url + "customer/customer_status",
                    data: {id: token, status: status},
//                      beforeSend: function () {
//                          $('#loadingmessage').show();
//                      },
                    success: function (result) {
//                      $('#loadingmessage').hide();
                        location.reload();
                        $.alert('Status Change');
                    }
                });
            }
        }
    }
});

function delete_customer() {
//    $("#delete-customer").confirm({
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure want to delete this customer?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            cancel: function () {
            },
            confirm: {
                text: 'Ok',
                btnClass: 'btn-red',
                action: function () {
                    var token = $("#delete-customer").attr("data-token");
                    $.ajax({
                        type: "GET",
                        url: site_url + "customer/delete_customer",
                        data: {id: token},
                        beforeSend: function () {
                            $('#loadingmessage').show();
                        },
                        success: function (result) {
                            $('#loadingmessage').hide();
                            $.alert('Customer Deleted');
                        }
                    });
                }
            }
        }
    });
}