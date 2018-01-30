<?php include APPPATH . '/modules/views/top.php'; ?>
<div class="row"> 
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <h1 class="text-left pull-left">Generate Invoice</h1>            
            <h1 class="text-right"><?php echo date("d/m/Y") ?></h1>            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <form id="add_invoice_form" method="post" action="<?php echo $this->config->item("site_url") . "invoice/add_invoice_action" ?>" name="add_invoice_form" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
            <!-- Customer Section-->

            <input type="hidden" id="total_gst" name="total_gst" value="<?php echo $total_gst; ?>"/>
            <input type="hidden" id="total_cgst" name="total_cgst" value="<?php echo $cgst; ?>"/>
            <input type="hidden" id="total_sgst" name="total_sgst" value="<?php echo $sgst; ?>"/>
            <input type="hidden" id="currsymbol" value="<?= CurrSymbol() ?>"/>

            <div class="x_panel" style="margin-bottom: 25px">
                <div class="x_title">
                    <h2>Customer Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="Customer" name="Customer">
                                    <option value="">Select Customer</option>
                                    <option value="" onclick="addCustomer(this);">ADD Customer</option>
                                    <?php foreach ($customer_data as $key => $val) { ?>
                                        <option data-phone="<?php echo $val['Phone']; ?>" data-gstno="<?php echo $val['GSTno']; ?>" data-address="<?php echo $val['Address']; ?>" data-lastname="<?php echo $val['Lastname']; ?>" data-firstname="<?php echo $val['Firstname']; ?>" value="<?php echo $val['ID']; ?>"><?php echo ucfirst($val['Firstname']) . " " . $val['Lastname']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row cust_info" style="display: none">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CustomerName">Customer Name</label>
                                <input tabindex="1"  readonly=""  id="CustomerName" placeholder="Name" name="CustomerName" class="form-control" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CustomerGSTNo">GSTIN No.</label>
                                <input tabindex="2" readonly="" id="CustomerGSTNo" placeholder="#123" name="CustomerGSTNo" class="form-control" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="PlaceOfSuppy">Place of Supply</label>
                                <input tabindex="3" required="" id="PlaceOfSuppy" placeholder="Place Of Supply" name="PlaceOfSuppy" class="form-control" type="text" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row cust_info" style="display: none">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CustomerAddress">Customer Address</label>
                                <textarea  tabindex="4" placeholder="Address" id="CustomerAddress" name="CustomerAddress" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CustomerPhone">Customer Phone</label>
                                <input  tabindex="5" id="CustomerPhone" placeholder="Phone" name="CustomerPhone" class="form-control integer" type="text" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Product Section-->
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product Details</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content" style="margin-bottom: 15px">
                    <div class="row table-responsive"  id="ProductSection">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Product Name</th>
                                    <th style="width: 8%">Qty</th>
                                    <th style="width: 8%">Rate</th>
                                    <th style="width: 8%">Amount</th>
                                    <th style="width: 8%">GST(%)</th>
                                    <th style="width: 8%">CGST</th>
                                    <th style="width: 8%">SGST</th>
                                    <th style="width: 10%">Net Amount</th>
                                </tr>
                            </thead>
                            <tbody id="ProductTable">
                                <tr id="mainproductblock1" class="mainproductblock tr_pro_1">
                                    <td><input required="" onblur="update_value(1)" tabindex="6" id="ProductName1" placeholder="Product Name" name="ProductName[]" class="form-control pro_name_1" type="text" value=""></td>
                                    <td><input required="" onblur="update_value(1)" tabindex="9" id="ProductQty1" placeholder="Qty" name="ProductQty[]" class="form-control integer pro_qty_1" min="1" maxlength="10" type="number" value=""></td>
                                    <td><input required="" onblur="update_value(1)" tabindex="10" id="ProductRate1" placeholder="Rate" name="ProductRate[]" class="form-control integer pro_rate_1" type="number" value=""></td>
                                    <td><?= CurrSymbol() ?> <span class="pro_amt_1">0.00</span></td>
                                    <td><?php echo $total_gst; ?></td>
                                    <td><span class="pro_cgst_1">0.00</span></td>
                                    <td><span class="pro_sgst_1">0.00</span></td>
                                    <td><?= CurrSymbol() ?> <span class="pro_net_amt_1">0.00</span></td>
                                </tr>
                            </tbody>
                            <tr>
                                <td colspan="2"></td>
                                <td>TOTAL</td>
                                <td><?= CurrSymbol() ?> <span id="total_pro_amt">0.00</span></td>
                                <td colspan="3"></td>
                                <td><?= CurrSymbol() ?> <span id="total_pro_net_amt">0.00</span></td>
                            </tr>
                        </table>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-info" onclick="addmore_product();">
                                Add More
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <input type="submit" value="Submit" class="btn btn-success">
                        <a href="javascript:void(0)" onclick="goBack();"  class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" id="sendinvoice" role="dialog" style="display: none; padding-left: 15px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal_header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title h4modal">Send Invoice</h4>
            </div>
            <div class="modal-body modal_header">
                <form class="form-horizontal" action="<?php echo $this->config->item("site_url") . "invoice/send_invoice" ?>" method="post" name="AddCustomerForm" id="AddCustomerForm"  enctype="multipart/form-data" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlable">First Name</label>
                                <div class="input-group">
                                    <input class="form-control" id="Firstname" name="Firstname" placeholder="Firstname" value="" type="text" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlable">Last Name</label>
                                <div class="input-group">
                                    <input class="form-control" id="Lastname" name="Lastname" placeholder="Lastname" value="" type="text" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlable">Email</label>
                                <div class="input-group">
                                    <input class="form-control" id="Email" name="Email" placeholder="Email" value="" type="email" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlable">Phone</label>
                                <div class="input-group">
                                    <input class="form-control" id="Phone" placeholder="Phone" name="Phone" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlabl col-xs-12">Address</label>
                                <div class="input-group">
                                    <textarea class="form-control"  id="Address" name="Address" required="" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">                        
                                <label class="control-label listlable">GST No</label>
                                <div class="input-group">
                                    <input class="form-control" id="GSTno" placeholder="GSTno" name="GSTno" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer btnmodal">
                <button type="button" id="SendInvoiceEmail" onclick="save_customer()" class=" btnlist">Save</button>
                <button type="button" class="close btn btn-default btnlist" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

    $('#Customer').change(function () {
        if ($(this).val() != "") {
            var Firstname = $(this).children('option:selected').data('firstname');
            var Lastname = $(this).children('option:selected').data('lastname');
            var Phone = $(this).children('option:selected').data('phone');
            var Address = $(this).children('option:selected').data('address');
            var GSTno = $(this).children('option:selected').data('gstno');

            $("#CustomerName").val(Firstname + " " + Lastname);
            $("#CustomerGSTNo").val(GSTno);
            $("#CustomerAddress").val(Address);
            $("#CustomerPhone").val(Phone);

            $(".cust_info").show();

        } else {
            $(".cust_info").hide();
            $("#CustomerName").val("");
            $("#CustomerGSTNo").val("");
            $("#CustomerAddress").val("");
            $("#CustomerPhone").val("");
            $("#PlaceOfSuppy").val("");
        }
    });

    function update_value(value) {
        var ProductQty = $.trim($("#ProductQty" + value).val());
        var ProductRate = $.trim($("#ProductRate" + value).val());

        if (ProductQty != null && ProductQty != "" && ProductRate != null && ProductRate != "") {
            var price = parseFloat(decimle_value(ProductQty) * decimle_value(ProductRate));
            $(".pro_amt_" + value).text(decimle_value(price));

            //Calculate CGST
            var cgst_val = ((price) * (cgst_value / 100));
            var sgst_val = ((price) * (sgst_value / 100));

            //net total
            var net_total = (price + cgst_val + sgst_val);

            $(".pro_cgst_" + value).text(decimle_value(cgst_val));
            $(".pro_sgst_" + value).text(decimle_value(cgst_val));
            $(".pro_net_amt_" + value).text(decimle_value(net_total));
            var total_pro_amt = 0;
            var total_pro_net_amt = 0;
            for (var i = value; i > 0; i--) {
                total_pro_amt += parseInt($(".pro_amt_" + i).text());
                total_pro_net_amt += parseInt($(".pro_net_amt_" + i).text());
            }
            $("#total_pro_amt").text(decimle_value(total_pro_amt));
            $("#total_pro_net_amt").text(decimle_value(total_pro_net_amt));
        } else {
            $(".pro_cgst_" + value).text("0.00");
            $(".pro_sgst_" + value).text("0.00");
            $(".pro_net_amt_" + value).text("0.00");
        }
    }
    function decimle_value(num) {
        return parseFloat(Math.round(num * 100) / 100).toFixed(2);
    }
    $(document).ready(function (e) {

        $("#add_invoice_form").validate({
            ignore: [],
            rules: {
                Customer: {
                    required: true,
                },
                CustomerName: {
                    required: true,
                },
                PlaceOfSuppy: {
                    required: true,
                },
                CustomerAddress: {
                    required: true,
                },
                'ProductName[]': {
                    required: true,
                },
            },
            submitHandler: function (form) {
                var baseurl = '<?php echo base_url(); ?>';
                $.ajax({
                    url: baseurl + "invoice/add_invoice_action",
                    type: "POST",
                    data: $("#add_invoice_form").serialize(),
                    beforeSend: function () {
                        $('#loadingmessage').show();
                    },
                    success: function (data) {
                        $('#loadingmessage').hide();
                        if (data == true) {
                            $("#add_invoice_form")[0].reset();
                            window.location = baseurl + "invoice";
                            ;
                        } else {
                            bootbox.alert("Unable to add invoice.Please try again.");
                            return false;
                        }
                    }
                });
            }
        });
    });
    var numItems = parseInt($.trim($('.mainproductblock').length + 1));
    var tabindex = 10;
    function addmore_product() {
        var currsymbol = $("#currsymbol").val();
        tabindex++;
        var html = '';
        html += '<tr id="mainproductblock' + numItems + '" class="mainproductblock tr_pro_' + numItems + '">';
        html += '<td><input required="" onblur="update_value(' + numItems + ')" tabindex=' + tabindex + ' id="ProductName' + numItems + '" placeholder="Product Name" name="ProductName[]" class="form-control pro_name_' + numItems + '" type="text" value=""></td>';
        html += '<td><input required="" onblur="update_value(' + numItems + ')" tabindex=' + tabindex + ' id="ProductQty' + numItems + '" placeholder="Qty" name="ProductQty[]" class="form-control integer pro_qty_' + numItems + '" min="1" maxlength="10" type="number" value=""></td>';
        html += '<td><input required="" onblur="update_value(' + numItems + ')" tabindex=' + tabindex + ' id="ProductRate' + numItems + '" placeholder="Rate" name="ProductRate[]" class="form-control integer pro_rate_' + numItems + '" type="number" value=""></td>';
        html += '<td>' + currsymbol + ' <span class="pro_amt_' + numItems + '">0.00</span></td>';
        html += '<td>' + gst_value + '</td>';
        html += '<td><span class="pro_cgst_' + numItems + '">0.00</span></td>';
        html += '<td><span class="pro_sgst_' + numItems + '">0.00</span></td>';
        html += '<td>' + currsymbol + ' <span style="margin-right:25px" class="pro_net_amt_' + numItems + '">0.00</span><button type="button" onclick="remove_product(' + numItems + ')" class="btn btn-sm btn-danger">X</button></td>';
        html += '</tr>';

        $("#ProductTable").append(html);
        numItems++;
    }

    function remove_product(element) {
        var Total = $("#total_pro_amt").text();
        var Total_net = $("#total_pro_net_amt").text();
        var current = parseInt($(".pro_amt_" + element).text());
        var net_current = parseInt($(".pro_net_amt_" + element).text());
        $("#total_pro_amt").text(decimle_value(parseInt(Total) - parseInt(current)));
        $("#total_pro_net_amt").text(decimle_value(parseInt(Total_net) - parseInt(net_current)));
        $("#mainproductblock" + element).remove();
    }
    function addCustomer() {
        $("#AddCustomerForm")[0].reset();
        $('#sendinvoice').modal("show");
    }
    function save_customer() {
        var AddCustomerForm = $("#AddCustomerForm").valid();
        if (AddCustomerForm) {
            $.ajax({
                url: site_url + "customer/add_invoice_action",
                type: "POST",
                data: $("#AddCustomerForm").serialize(),
                beforeSend: function () {
                    $('#loadingmessage').show();
                },
                success: function (data) {
                    $('#loadingmessage').hide();
                    $("#CustomerName").val($("#Firstname").val() + " " + $("#Lastname").val());
                    $("#CustomerGSTNo").val($("#GSTno").val());
                    $("#CustomerAddress").val($("#Address").val());
                    $("#CustomerPhone").val($("#Phone").val());
                    $("#Customer").append("<option data-phone=" + $("#Phone").val() + " data-gstno=" + $("#GSTno").val() + " data-address=" + $("#Address").val() + " data-lastname=" + $("#Lastname").val() + " data-firstname=" + $("#Firstname").val() + " value=" + data + " selected>" + $("#Firstname").val() + " " + $("#Lastname").val() + "</option>")
                    $(".cust_info").show();
                    $('#sendinvoice').modal("hide");
                }
            });
        }
    }
</script>
<?php
include APPPATH . '/modules/views/footer.php';
