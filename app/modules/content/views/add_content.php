<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <form id="product_form" method="post" action="<?php echo $this->config->item("site_url") . "content_add_action" ?>"class="form-horizontal form-label-left input_mask">
            <div class="x_content">
                <div data-example-id="togglable-tabs" role="tabpanel" class="">
                    <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
                        <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="about" href="#tab_content1">Add New Content</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="about" id="tab_content1" class="tab-pane fade active in" role="tabpanel">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input type="text" id="page" value="<?php echo set_value('page'); ?>" name="page" placeholder="page" class="form-control"/>
                                <?php echo form_error('page'); ?>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text"  value="<?php echo set_value('code'); ?>"  id="code" name="code" placeholder="code" class="form-control"/>
                                <?php echo form_error('code'); ?>
                            </div>
                            <div class="form-group">
                                <label>Support</label>
                                <textarea name="content" id="content" class="ckeditor" rows = "4"><?php echo set_value('content'); ?></textarea>
                                <?php echo form_error('content'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" value="Submit" class="btn btn-success">
                            <a href="<?php echo base_url('content_management'); ?>" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include APPPATH . '/front-modules/views/footer.php';
