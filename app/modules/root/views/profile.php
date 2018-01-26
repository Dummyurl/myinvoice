<?php include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>My Profile</h2>

                <div class="clearfix"></div>
            </div>
            <form id="profile_form" method="post" action="<?php echo $this->config->item("site_url") . "profile_action" ?>" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                <div class="x_content">
                    <br />

                    <input type="hidden" name="aid" id="aid" value="<?php echo ($all['ID'] != '') ? $all['ID'] : 0; ?>"/>
                    <input type="hidden" name="chnagepass" id="chnagepassval" value="0"/>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="firstname" required="" name="firstname" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['Firstname'] != '') ? $all['Firstname'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="lastname" required="" name="lastname" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['Lastname'] != '') ? $all['Lastname'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" required="" name="email" class="form-control col-md-7 col-xs-12" type="email" value="<?php echo ($all['Email'] != '') ? $all['Email'] : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group" id="changpassbtndiv">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                                
                            <button type="button" class="btn btn-sm btn-success" id="changpassbtn" name="changpassbtn"><i class="fa fa-floppy-o"></i> Change Password</button>
                            <button type="button" class="btn btn-sm btn-success" id="cancelpassbtn" name="cancelpassbtn"><i class="fa fa-floppy-o"></i> Cancel</button>
                        </div>
                    </div>
                    <div id="passdiv">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" name="password" class="form-control col-md-7 col-xs-12" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="pass" name="pass" class="form-control col-md-7 col-xs-12" type="password">
                            </div>
                        </div>
                    </div>
                    <?php if ($all['ID'] == '') { ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" class="form-control col-md-7 col-xs-12" id="image" name="image" data-buttonText="Find file">
                            </div>
                        </div>        
                    <?php } else { ?>
                        <div class="form-group">                                        
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="columns-text">Image : </label>                                        
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php
                                $img_url = '';

                                if ($all['ProfileImage'] != '') {
                                    $img = 'admin/' . $all['ProfileImage'];
                                    $img_path = $this->config->item('upload_path') . $img;
                                    if (file_exists($img_path)) {
                                        $img_url = $this->config->item('upload_url') . $img;
                                    } else {
                                        $img_url = $this->config->item('upload_url') . 'no-image.png';
                                    }
                                }
                                ?>
                                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12"  style="<?php echo ($img_url != '') ? 'display:none' : ''; ?>" >
                                <button type="button" id="cancel" class="btn btn-danger" style="display:none; margin-top: 0.3em;"><i class="fa fa-times"></i></button>
                                <?php if ($img_url != '') { ?>
                                    <div class="avatar-view" title="" id="vProfileImg">

                                        <img src="<?php echo $this->config->item('upload_url') . 'admin/' . $all['ProfileImage']; ?>"  alt="photo" class="img-responsive" style="height: 150px"></a>
                                        <button type="button" id="change" class="btn btn-success"><i class="fa fa-repeat"></i></button>
                                        <button type="button" id="Deleteimg" title="Delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>

                                    </div>
                                <?php } ?>
                            </div>                                       
                        </div>
                    <?php } ?> 
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                        <input type="submit" value="Submit" class="btn btn-success">
                        <a href="<?php echo base_url(); ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/profile.js"></script>
<script>
    $(document).ready(function (e) {
        $("#profile_form").validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                }
            }
        });
    });
</script>
<?php
include APPPATH . '/modules/views/footer.php';
