<?php include APPPATH . '/front-modules/views/top.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Customer</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="setting_form" method="post" action="<?php echo $this->config->item("site_url") . "customer/add_invoice_action" ?>" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Firstname">First Name<span class="required">*</span></label>
                            <input id="Firstname"  placeholder="First Name" name="Firstname" maxlength="100" class="form-control" type="text" value="<?php echo set_value('Firstname'); ?>">
                            <?php echo form_error('Firstname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Lastname">Last Name<span class="required">*</span></label>
                            <input id="Lastname" placeholder="Last Name" name="Lastname" class="form-control" type="text" value="<?php echo set_value('Lastname'); ?>">
                            <?php echo form_error('Lastname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Email">Email</label>
                            <input id="Email" placeholder="Email" name="Email" class="form-control" type="email" value="<?php echo set_value('Email'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Phone">Phone</label>
                            <input id="Phone" minlength="10"  placeholder="Phone" name="Phone" class="form-control integer" type="text" value="<?php echo set_value('Phone'); ?>">
                            <?php echo form_error('Phone'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="Address">Address<span class="required">*</span></label>
                            <textarea  id="Address" placeholder="Address" name="Address" class="form-control" ><?php echo set_value('Address'); ?></textarea>
                            <?php echo form_error('Address'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="GSTNo">GST No</label>
                            <input id="GSTno" placeholder="GST No" name="GSTno" class="form-control" type="text" value="<?php echo set_value('GSTno'); ?>">
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
</div>

<?php
include APPPATH . '/front-modules/views/footer.php';
