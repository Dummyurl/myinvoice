<div class="col-md-3 left_col" style="min-height: 100%;background: #2A3F54;position: fixed" >

    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <?php $image_url = $this->config->item("upload_url"); ?>
            <a href="<?php echo $this->config->item("site_url") . "dashboard"; ?>" class="site_title"> <span> <img src="<?php echo base_url() . "public/images/logo.png"; ?>" width="150" style="margin-left:25px;"></span></a>
        </div>
        <div class="clearfix"></div>
        <br />  
        <?php
        $users_class = '';
        $invoice_class = '';
        $settings_class = '';
        $Dashboard = '';
        $payment_class = '';
        $request_class = '';
        $customer_class = '';

        $url_segment = trim($this->uri->segment(1));
        $userArr = array("users", "user_details");
        $invoiceArr = array("add_invoice", "invoice");
        $contentarr_class = array("customer", "add_customer", "edit_customer", "content_update_action");

        if (isset($url_segment) && $url_segment == "dashboard")
            $Dashboard = "current-page";
        if (isset($url_segment) && in_array($url_segment, $userArr)) {
            $users_class = "current-page";
        } elseif (isset($url_segment) && in_array($url_segment, $invoiceArr)) {
            $invoice_class = "current-page";
        } elseif (isset($url_segment) && $url_segment == "settings") {
            $settings_class = "current-page";
        } elseif (isset($url_segment) && $url_segment == "payment") {
            $payment_class = "current-page";
        } elseif (isset($url_segment) && $url_segment == "request") {
            $request_class = "current-page";
        } elseif (isset($url_segment) && in_array($url_segment, $contentarr_class)) {
            $customer_class = "current-page";
        }
        ?>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu custom_bg">
            <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                    <li class="li_text <?php echo $Dashboard; ?>"><a href="<?php echo $this->config->item("site_url"); ?>dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="li_text <?php echo $customer_class; ?>"><a href="<?php echo $this->config->item("site_url"); ?>customer"><i class="fa fa-user-plus"></i> Customer</a></li>
                    <li class="li_text <?php echo $invoice_class; ?>"><a href="<?php echo $this->config->item("site_url"); ?>invoice"><i class="fa fa-credit-card"></i> Invoice</a></li>
                    <li class="li_text <?php echo $settings_class; ?>"><a href="<?php echo $this->config->item("site_url"); ?>settings"><i class="fa fa-gear"></i> Settings</a></li>
                    <li style="bottom: 0;position: absolute;font-size: 11px;padding: 5px;color: #9FBDDD;text-align: center;"><span>Copyright© <?php echo date("Y") . " " . MY_SITE_NAME; ?></span></li>
                </ul>
            </div>
        </div>        
    </div>
</div>