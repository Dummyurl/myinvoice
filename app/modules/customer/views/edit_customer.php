<?php
include APPPATH . '/modules/views/top.php';


$ID_Value = set_value('ID') ? set_value('ID') : $Customer['ID'];
$Firstname = set_value('Firstname') ? set_value('Firstname') : $Customer['Firstname'];
$Lastname = set_value('Lastname') ? set_value('Lastname') : $Customer['Lastname'];
$Email = set_value('Email') ? set_value('Email') : $Customer['Email'];
$Phone = set_value('Phone') ? set_value('Phone') : $Customer['Phone'];
$Address = set_value('Address') ? set_value('Address') : $Customer['Address'];
$GSTno = set_value('GSTno') ? set_value('GSTno') : $Customer['GSTno'];
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Update Customer <?php echo $Customer['Firstname']; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="setting_form" method="post" action="<?php echo $this->config->item("site_url") . "customer/update_invoice_action" ?>" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">

                    <input type="hidden" id="ID" name="ID" value="<?php echo $ID_Value; ?>"/>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Firstname">First Name<span class="required">*</span></label>
                            <input id="Firstname"  placeholder="First Name" name="Firstname" maxlength="100" class="form-control" type="text" value="<?php echo $Firstname; ?>">
                            <?php echo form_error('Firstname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Lastname">Last Name<span class="required">*</span></label>
                            <input id="Lastname" placeholder="Last Name" name="Lastname" class="form-control" type="text" value="<?php echo $Lastname; ?>">
                            <?php echo form_error('Lastname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Email">Email</label>
                            <input id="Email" placeholder="Email" name="Email" class="form-control" type="email" value="<?php echo $Email; ?>">
                            <?php echo form_error('Email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Phone">Phone</label>
                            <input id="Phone" minlength="10" maxlength="10"  placeholder="Phone" name="Phone" class="form-control integer" type="text" value="<?php echo $Phone; ?>">
                            <?php echo form_error('Phone'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Address">Address<span class="required">*</span></label>
                            <textarea  id="Address" placeholder="Address" name="Address" class="form-control" ><?php echo $Address; ?></textarea>
                            <?php echo form_error('Address'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="GSTNo">GST No</label>
                            <input id="GSTno" placeholder="GST No" name="GSTno" class="form-control" type="text" value="<?php echo $GSTno; ?>">
                            <?php echo form_error('GSTno'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" value="Submit" class="btn btn-success">
                            <a href="<?php echo base_url("customer"); ?>" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include APPPATH . '/modules/views/footer.php';
