<?php include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="setting_form" method="post" action="<?php echo $this->config->item("site_url") . "settings/invoice_action" ?>" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="CompanyName">Company Name<span class="required">*</span></label>
                                <input id="CompanyName" required="" placeholder="First Name" name="CompanyName" maxlength="100" class="form-control" type="text" value="<?php echo ($all['CompanyName'] != '') ? $all['CompanyName'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="OwnerName">Owner Name<span class="required">*</span></label>
                                <input id="OwnerName" required="" placeholder="Owner Name" name="OwnerName" class="form-control" type="text" value="<?php echo ($all['OwnerName'] != '') ? $all['OwnerName'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="Phone">Company Phone<span class="required">*</span></label>
                                <input id="CompanyPhone" required="" placeholder="Company Phone" name="CompanyPhone" class="form-control" type="text" value="<?php echo ($all['CompanyPhone'] != '') ? $all['CompanyPhone'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">

                                <label for="CompanyMobile">Company Mobile<span class="required">*</span></label>
                                <input id="CompanyMobile" required="" placeholder="Company Mobile" minlength="10" maxlength="13" name="CompanyMobile" class="form-control" type="text" value="<?php echo ($all['CompanyMobile'] != '') ? $all['CompanyMobile'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="Address">Address<span class="required">*</span></label>
                                <input id="Address" required="" placeholder="Address" name="Address" class="form-control" type="text" value="<?php echo ($all['Address'] != '') ? $all['Address'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="City">City<span class="required">*</span></label>
                                <input id="City" required="" placeholder="City" name="City" class="form-control" type="text" value="<?php echo ($all['City'] != '') ? $all['City'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="PinCode">Pin Code<span class="required">*</span></label>
                                <input id="PinCode" required="" placeholder="PinCode" name="PinCode" class="form-control" type="text" value="<?php echo ($all['PinCode'] != '') ? $all['PinCode'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="GSTPercentage">GST Percentage<span class="required">*</span></label>
                                <input id="GSTPercentage" required="" placeholder="GST %" name="GSTPercentage"  maxlength="3" max="100" class="form-control" min="1" type="number" value="<?php echo ($all['GSTPercentage'] != '') ? $all['GSTPercentage'] : 0; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="GSTNo">GST No<span class="required">*</span></label>
                                <input id="GSTNo" required="" placeholder="GST No" name="GSTNo" class="form-control" type="text" value="<?php echo ($all['GSTNo'] != '') ? $all['GSTNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">                                        
                                <label for="columns-text">Image : </label>                                        
                                <?php
                                $img_url = '';
                                if ($all['CompanyLogo'] != '') {
                                    $img = 'images/' . $all['CompanyLogo'];
                                    $img_path = $this->config->item('upload_url') . $img;
                                    if (file_exists($img_path)) {
                                        $img_url = $this->config->item('upload_url') . $img;
                                    } else {
                                        $img_url = $this->config->item('upload_url') . 'no-image.png';
                                    }
                                }
                                ?>
                                <input type="file" id="CompanyLogo" name="CompanyLogo" class="form-control col-md-7 col-xs-12">
                            </div>  
                            <?php if ($img_url != '') { ?>
                                <div class="avatar-view" title="" id="vProfileImg" style="height: 100px;margin-top: 20px;margin-bottom: 20px;width: 100px;">
                                    <img src="<?php echo $this->config->item('upload_url') . 'images/' . $all['CompanyLogo']; ?>"  alt="photo" class="img-responsive" id="CompanyLogoPreView" style="height: 100px;width: 100px;"></a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="CurrencySymbol">Currency Symbol<span class="required">*</span></label>
                                <select name="CurrencySymbol" id="CurrencySymbol" class="form-control" required="">
                                    <option value="">Select Currency Symbol</option>
                                    <option value="₵">Cedi ( ₵ )</option>
                                    <option value="$">Dollar ( $ )</option>
                                    <option value="€">Euro ( € )</option>
                                    <option value="ƒ">Florin ( ƒ )</option>
                                    <option value="£">Pound ( £ )</option>
                                    <option value="₹">Rupee ( ₹ )</option>
                                    <option value="¥">Yuan ( ¥ )</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-success">
                                <a href="<?php echo base_url("dashboard"); ?>" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function (e) {
        $("#setting_form").validate({
            rules: {
                CompanyName: {
                    required: true,
                },
                OwnerName: {
                    required: true,
                },
                Phone: {
                    required: true,
                },
                Address: {
                    required: true,
                },
                City: {
                    required: true,
                },
                PinCode: {
                    required: true,
                },
                GSTNo: {
                    required: true,
                },
            }
        });
        $('#CompanyLogo').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#CompanyLogoPreView").attr("src", e.target.result);

            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
<?php
include APPPATH . '/modules/views/footer.php';
