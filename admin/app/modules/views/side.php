<div class="col-md-3 left_col" style="min-height: 100%;background: #2A3F54;position: fixed" >

    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <?php
//            $img_name = get_logo();
//            if ($img_name != '') {
//                $img = 'images/' . $img_name;
//                $img_path = $this->config->item('upload_url') . $img;
//                $img_url = $this->config->item('upload_url') . $img;
//            } else {
//                $img_url = $this->config->item('upload_url') . 'no-image.png';
//            }
            ?>
            <a href="<?php echo $this->config->item("root_dir"); ?>" class="site_title"> <span> <img src="<?php echo $this->config->item("images_url") . "logo.png"; ?>"style="margin-left:38px;width: 120px;height: 60px;"></span></a>
        </div>
        <div class="clearfix"></div>
        <br />  
        <?php
        $users = '';
        $Dashboard = '';
        $customer = '';

        $url_segment = trim($this->uri->segment(1));
        $userArr = array("users");
        $customerArr = array("customer");

        if (isset($url_segment) && $url_segment == "dashboard") {
            $Dashboard = "current-page";
        } elseif (isset($url_segment) && in_array($url_segment, $userArr)) {
            $user = "current-page";
        } elseif (isset($url_segment) && in_array($url_segment, $customerArr)) {
            $customer = "current-page";
        }
        ?>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu custom_bg">
            <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                    <li class="li_text <?php echo $Dashboard; ?>"><a href="<?php echo $this->config->item("site_url"); ?>dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="li_text <?php echo $user; ?>"><a href="<?php echo $this->config->item("site_url"); ?>user"><i class="fa fa-user"></i> User</a></li>
                    <li class="li_text <?php echo $customer; ?>"><a href="<?php echo $this->config->item("site_url"); ?>customer"><i class="fa fa-users"></i> Customer</a></li>
                    <li style="bottom: 0;position: absolute;font-size: 11px;padding: 5px;color: #9FBDDD;text-align: center;"><span>Copyright© <?php echo date("Y") . " " . MY_SITE_NAME; ?></span></li>
                </ul>
            </div>
        </div>        
    </div>
</div>