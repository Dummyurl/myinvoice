function add_cart(element) {
    var pid = $(element).val();
    var qty = $('option:selected', element).attr('data-qty');
    var val = $('option:selected', element).attr("data-orderqty");
    var price = $('option:selected', element).attr("data-price");
    $("#Product_ID").val(pid);
    $("#Qty").attr("min", qty);
    $("#Qty").val(qty);
    if (val > 0) {
        $("#btnAddCart").text("Edit Cart");
        $(".modal-title").text("Edit Cart");
    } else {
        $("#btnAddCart").text("Add Cart");
        $(".modal-title").text("Add Cart");
    }
    $(".note").html("Please enter minimum quantity : <b>" + parseInt(qty) + "</b>");
    $(".pprice").html("Price : <b>$" + price + "</b>");
    $("#AddToCart").modal("show");

}
$('#AddToCart').on('hidden.bs.modal', function () {
    $("#products").val("");
});
function change_order(element) {
    var pid = $(element).attr("data-pid");
    var qty = $(element).attr("data-qty");
    var val = $(element).attr("data-val");
    $("#Product_ID").val(pid);
    $("#Qty").attr("min", qty);
    $("#Qty").val(val);
    if (val > 0) {
        $("#btnAddCart").text("Edit Cart");
        $(".modal-title").text("Edit Cart");
    } else {
        $("#btnAddCart").text("Add Cart");
        $(".modal-title").text("Add Cart");
    }
//        $("#Qty").val(qty);
    $(".note").html("Please enter minimum quantity : " + parseInt(qty));
    $("#AddToCart").modal("show");

}
$(".integer,.custinteger").keydown(function (e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
$("#same_as_billing").on("change", function () {
    if (this.checked) {
        $("[name='sname']").val($("[name='name']").val());
        $("[name='saddress']").val($("[name='address']").val());
        $("[name='scity']").val($("[name='city']").val());
        $("[name='sstate']").val($("[name='state']").val());
        $("[name='szip']").val($("[name='zip']").val());
        $("[name='sphone']").val($("[name='phone']").val());
    } else {
        $("[name='sname']").val('');
        $("[name='saddress']").val('');
        $("[name='scity']").val('');
        $("[name='sstate']").val('');
        $("[name='szip']").val('');
        $("[name='sphone']").val('');
    }
});
$(document).ready(function () {
    $("#BillingForm").validate({
        rules: {
            name: {
                required: true,
            },
            address: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            zip: {
                required: true,
            },
            phone: {
                required: true,
            },
            sname: {
                required: true,
            },
            saddress: {
                required: true,
            },
            scity: {
                required: true,
            },
            sstate: {
                required: true,
            },
            szip: {
                required: true,
            },
            sphone: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter name"
            },
            address: {
               required: "Please enter address"
            },
            city: {
              required: "Please enter city"
            },
            state: {
               required: "Please select state"
            },
            zip: {
               required: "Please enter zip"
            },
            phone: {
               required: "Please enter phone"
            },
            sname: {
                required: "Please enter name"
            },
            saddress: {
                required: "Please enter address"
            },
            scity: {
               required: "Please enter city"
            },
            sstate: {
               required: "Please select state"
            },
            szip: {
                required: "Please enter zip"
            },
            sphone: {
               required: "Please enter phone"
            }
        }

    });
    $("#BillingForm").submit(function () {
        if ($("#BillingForm").valid()) {
            $('#loadingmessage').show();
        }
    });
    $("#OrderFrom").submit(function () {
        if ($("#OrderFrom").valid()) {
            $('#loadingmessage').show();
        }
    });
});
jQuery(function ($) {
    $("#phone").mask("(999) 999-9999");
    $("#sphone").mask("(999) 999-9999");
});