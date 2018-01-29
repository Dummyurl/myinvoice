<?php
$title = isset($title) ? $title : '';

$url_segment = trim($this->uri->segment(1));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo MY_SITE_NAME . " | " . $title; ?></title>
        <?php include APPPATH . '/modules/views/dashboard_css.php'; ?>
        <script src="<?php echo $this->config->item('admin_js_url'); ?>jquery-3.1.1.min.js"></script>
        <!-- Jquery Validate -->
        <script src="<?php echo $this->config->item('admin_js_url'); ?>plugins/validate/jquery.validate.min.js"></script>
        <script src="<?php echo $this->config->item('js_url'); ?>additional-method.js"></script>
        <script>
            var base_url = '<?php echo base_url() ?>';
            var csrf_token_name = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <link rel="icon" href="<?php echo base_url() . img_path; ?>/favicon.ico">
    </head>
    <body>
        <div class="loadingmessage" id="loadingmessage"></div>
        <div id="wrapper">
            <div class="row border-bottom mb-17" style="margin-bottom: 75px;">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="position: fixed;top: 0;width: 100%;right: 0;margin-bottom: 0;padding: 15px;">

                    <a class="navbar-brand text-center" href=" <?php echo base_url() ?>"> <img alt="image" src="<?php echo $this->config->item('images_url'); ?>logo.png" style="width: 90%;"/></a>

                    <ul class="nav navbar-top-links navbar-right" style="line-height: 0;">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </li>
                        <?php if ($this->session->userdata("UserType") != "C") { ?>
                            <li>
                                <a href="<?php echo base_url("profile"); ?>">
                                    <i class="fa fa-lock"></i> Profile Setting
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo base_url("update-password"); ?>">
                                <i class="fa fa-square"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("logout"); ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>