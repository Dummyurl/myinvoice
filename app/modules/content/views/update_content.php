<?php
include APPPATH . '/front-modules/views/top.php';
$page = isset($content_data[0]['page']) ? $content_data[0]['page'] : set_value('page');
$code = isset($content_data[0]['code']) ? $content_data[0]['code'] : set_value('code');
$content = isset($content_data[0]['content']) ? $content_data[0]['content'] : set_value('content');
$id = isset($content_data[0]['id']) ? $content_data[0]['id'] : $ids;
?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <form id="product_form" method="post" action="<?php echo $this->config->item("site_url") . "content_update_action" ?>"class="form-horizontal form-label-left input_mask">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div class="x_content">
                <div data-example-id="togglable-tabs" role="tabpanel" class="">
                    <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
                        <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="about" href="#tab_content1">Update <?php echo $page ?> content</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="about" id="tab_content1" class="tab-pane fade active in" role="tabpanel">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input type="text" id="page" readonly="readonly" value="<?php echo $page; ?>" name="page" placeholder="page" class="form-control"/>
                                <?php echo form_error('page'); ?>
                            </div>
                            <div class="form-group">
                                <label>Support</label>
                                <textarea name="content" id="content" class="ckeditor" rows = "4"><?php echo $content; ?></textarea>
                                <?php echo form_error('content'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" value="Save" class="btn btn-success">
                            <a  href="<?php echo base_url('content_management'); ?>" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include APPPATH . '/front-modules/views/footer.php';
