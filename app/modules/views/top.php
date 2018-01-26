<?php
//get Current admin details
$admin_data = get_user_details();
//echo '<pre>';
//print_r($admin_data);
//exit;
$gst_data = $this->model_support->getGstDetail();

$cgst = 0;
$sgst = 0;
$total_gst = 0;

if ($gst_data > 0) {
    $cgst = $gst_data[0]['GSTPercentage'] / 2;
    $total_gst = $gst_data[0]['GSTPercentage'];
    $sgst = $gst_data[0]['GSTPercentage'] / 2;
}

$afirst_name = isset($admin_data['Firstname']) ? $admin_data['Firstname'] : "Admin";
$alast_name = isset($admin_data['Lastname']) ? $admin_data['Lastname'] : "User";
$aimage = isset($admin_data['ProfileImage']) ? $admin_data['ProfileImage'] : "no-image.png";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified right now
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
// HTTP/1.0
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo isset($title) ? $title : MY_SITE_NAME; ?></title>
        <link rel="icon" href="<?php echo $this->config->item('images_url'); ?>favicon.png" type="image/x-icon" />
        <?php include APPPATH . '/modules/views/common_files.php'; ?>    
        <script>
            var js_url = '<?php echo $this->config->item("site_url") ?>';
            var cgst_value = '<?php echo $cgst; ?>';
            var sgst_value = '<?php echo $sgst; ?>';
            var gst_value = '<?php echo $total_gst; ?>';
        </script>
        <style>
            .loadingmessage{
                position: fixed;
                opacity: 0.7;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999999;
                background: url("<?php echo $this->config->item('images_url'); ?>loading.gif") 50% 50% no-repeat rgb(249,249,249);display: none;
            }
        </style>
    </head>
    <body class="nav-md">
        <div id='loadingmessage'  class="loadingmessage"></div>
        <div class="container body">
            <div class="main_container">
                <?php include APPPATH . '/modules/views/side.php'; ?>  
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo $this->config->item("upload_url") . 'admin/' . $aimage; ?>" alt="" 
                                             onerror="this.src = '<?php echo $this->config->item("upload_url") . "no-image.png" ?>';"
                                             ><?php echo ucfirst($afirst_name) . " " . ucfirst($alast_name); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo $this->config->item("site_url") . "profile" ?>">  Profile</a>
                                        </li>                                        
                                        <li><a href="<?php echo $this->config->item("site_url") . "logout" ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <?php include APPPATH . '/modules/views/notification_message.php'; //footer file       ?>
                <div class="right_col" role="main">
