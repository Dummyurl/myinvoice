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
function change_order(element) {
    var pid = $(element).attr("data-pid");
    var qty = $(element).attr("data-qty");
    var val = $(element).attr("data-val");
    $("#Product_ID").val(pid);
    $("#Qty").attr("min", qty);
    if (val > 0) {
        $("#Qty").val(val);
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

function change_dealer_price(element) {
    var pid = $(element).attr("data-pid");
    var did = $(element).attr("data-did");
    
    $("#Product_ID").val(pid);
    $("#Dealer_ID").val(did);
    
    $("#DealerPrice").modal("show");

}
function setFormValidation(id) {
    $(id).validate({
        errorPlacement: function (error, element) {
            $(element).parent('div').addClass('has-error');
        }
    });
}
$(document).ready(function () {
    $("#FrmChangePrice").validate({
        rules: {
            Product_Price: {
                required: true,
            }
        },
        messages: {
            Product_Price: {
                required: "Please enter price"
            }
        }

    });
    $("#FrmChangePrice").submit(function () {
        if ($("#FrmChangePrice").valid()) {
            $('#loadingmessage').show();
        }
    });
    $("#ChangeDealerPriceForm").validate({
        rules: {
            Qty: {
                required: true,
            }
        },
        messages: {
            Qty: {
                required: "Please enter quantity"
            }
        }

    });
    $("#ChangeDealerPriceForm").submit(function () {
        if ($("#ChangeDealerPriceForm").valid()) {
            $('#loadingmessage').show();
        }
    });
});