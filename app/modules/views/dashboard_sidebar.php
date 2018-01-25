<?php
//GET ROLE PERMISSION
$get_role = $this->session->userdata("UserType");
//echo $get_role;exit;
$this->db->select('*');
$this->db->where('Role', $get_role);
$get_result = $this->db->get('tbl_role_permission')->row_array();
$module = explode(",", $get_result['Module']);

//ACTIVE SIDEBAR
$url_segment = trim($this->uri->segment(1));
$sitesetting_active = "";
$mainmenu_active = "";
$mainmenu_activeArr = array("main", "create-main", "create-main-save", "main-edit-action", "main-edit");
$testimonial_active = "";
$Dashboard = $meta_active = $change_password_active = $profile_active = $manager_active = $cms_active = $background_active = $accountant_active = $cart_active = $role_active = $sales_active = $customer_active = $product_active = $order_active = $customer_report_active = $sales_report_active = $page_active = $banner_active = $tabular_report_active = '';
$sitesettingArr = array("sitesetting", "site-setting-action");

$sales_activeArr = array("sales", "create", "edit", "edit-action", "create-sales");
$manager_activeArr = array("manager", "create_action_manager", "edit-manager", "edit-action-manager", "create-manager");
$customer_activeArr = array("customer", "add", "create-customer", "edit-customer", "update-customer", "dealer-products", "change_dealer_price");
$product_activeArr = array("product", "create-product", "create-product-action", "edit-product", "update-product", "product-details");
$product_category_activeArr = array("product_category", "create-product-category", "edit-product-category", "delete-product-category", "create-product-category-save", "edit-product-category-save" , "update-product-category-status" , "do-upload");
$order_activeArr = array("order", "order-details");
$profile_activeArr = array("profile", "profile-save");
$change_password_activeArr = array("update-password", "update-password-action");
$report_activeArr = array("report");
$cart_activeArr = array("cart");
$customer_report_activeArr = array("customer-report");
$tabular_report_activeArr = array("all-report");
$page_activeArr = array("page", "create-page", "create-page-save", "page-edit-action", "page-edit");
$testimonial_activeArr = array("testimonial", "create-testimonial", "create-testimonial-save", "testimonial-edit-action", "testimonial-edit");
$banner_activeArr = array("banner", "create-banner", "create-banner-save", "banner-edit-action", "banner-edit");
$background_activeArr = array("background", "create-background", "create-background-save", "background-edit", "background-edit-action");
$role_activeArr = array("role", "add-role", "add-role-action", "delete-role");
$accountant_activeArr = array("accountant", "add-accountant", "add-accountant-action", "delete-accountant", "update-accountant", "update-accountant-action");
$cms_activeArr = array("cms", "create-cms", "create-cms-save", "edit-cms", "edit-cms-save", "delete-cms");
$meta_activeArr = array("meta", "manage-meta", "manage-meta-action", "meta-status", "meta-delete");
/////////////////////////////////////////////////////////////////////////////////////////////
if (isset($url_segment) && in_array($url_segment, $sales_activeArr)) {
    $sales_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $manager_activeArr)) {
    $manager_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $customer_activeArr)) {
    $customer_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $product_activeArr)) {
    $product_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $order_activeArr)) {
    $order_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $page_activeArr)) {
    $page_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $banner_activeArr)) {
    $banner_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $profile_activeArr)) {
    $profile_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $change_password_activeArr)) {
    $change_password_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $customer_report_activeArr)) {
    $customer_report_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $report_activeArr)) {
    $sales_report_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $tabular_report_activeArr)) {
    $tabular_report_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $role_activeArr)) {
    $role_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $cart_activeArr)) {
    $cart_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $accountant_activeArr)) {
    $accountant_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $background_activeArr)) {
    $background_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $cms_activeArr)) {
    $cms_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $meta_activeArr)) {
    $meta_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $sitesettingArr)) {
    $sitesetting_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $testimonial_activeArr)) {
    $testimonial_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $mainmenu_activeArr)) {
    $mainmenu_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $product_category_activeArr)) {
   $product_category_active = "active";
}else {
    $Dashboard = "active";
}
?>

<nav class="navbar-default navbar-static-side " role="navigation" style="height: 100%">
    <div class="sidebar-collapse" style="height: 100%">
        <ul class="nav metismenu" id="side-menu" style="height: 100%">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" src="<?php echo $this->config->item('images_url'); ?>logo.png" style="width: 90%" />
                    </span>
                </div>
                <div class="logo-element">
                    BLR
                </div>
            </li>
            <?php if (isset($module) && in_array("dashboard", $module)) { ?>
                <li class="<?php echo $Dashboard; ?>">
                    <a href="<?php echo base_url("dashboard"); ?>"><i class="fa fa-home"></i><span class="nav-label">Dashboards</span></a>
                </li>
            <?php } if (isset($module) && in_array("sales", $module)) { ?>
                <li class="nav-item dropdown <?php echo $sales_active; ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url("sales"); ?>" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i>
                        <span class="nav-label">Sales</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="dropdown-menu dropdown nav-second-level" aria-labelledby="dropdown01">
                        <li class="<?php echo $sales_active; ?>">
                            <a class="dropdown-item" href="<?php echo base_url("sales"); ?>">
                                <i class="fa fa-gears"></i>
                                Manage Sales
                            </a>
                        </li>
                    </ul>
                </li>

            <?php } if (isset($module) && in_array("customer", $module)) { ?>
                <li class="nav-item dropdown <?php echo $customer_active; ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url("customer"); ?>" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i>
                        <span class="nav-label">Customer</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="dropdown-menu dropdown nav-second-level" aria-labelledby="dropdown02">
                        <li class="<?php echo $customer_active; ?>">
                            <a class="dropdown-item" href="<?php echo base_url("customer"); ?>">
                                <i class="fa fa-gears"></i>
                                Manage Customer
                            </a>
                        </li>
                    </ul>
                </li>

            <?php }if (isset($module) && in_array("product", $module)) { ?>
                <li class="nav-item dropdown <?php echo $product_active; ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url("product"); ?>" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-italic"></i>
                        <span class="nav-label">Product</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="dropdown-menu dropdown nav-second-level" aria-labelledby="dropdown03">
                        <li class="<?php echo $product_active; ?>">
                            <a class="dropdown-item" href="<?php echo base_url("product"); ?>">
                                <i class="fa fa-gears"></i>
                                Manage Product
                            </a>
                        </li>
                    </ul>
                </li>
                
                <?php } if (isset($module) && in_array("product-category", $module)) { ?>
                <li class="<?php echo $order_active; ?>">
                    <a href="<?php echo base_url("product-category"); ?>">
                        <i class="fa fa-inbox"></i>
                        <span class="nav-label">
                            Product Category
                        </span>
                    </a>
                </li>
            <?php } if (isset($module) && in_array("order", $module)) { ?>
                <li class="<?php echo $order_active; ?>">
                    <a href="<?php echo base_url("order"); ?>">
                        <i class="fa fa-inbox"></i>
                        <span class="nav-label">
                            Order History
                        </span>
                    </a>
                </li>
            <?php } if (isset($module) && in_array("cart", $module)) { ?>
                <li class="<?php echo $cart_active; ?>">
                    <a href="<?php echo base_url("cart"); ?>">
                        <i class="fa fa-gear"></i>
                        <span class="nav-label">Cart</span>
                    </a>
                </li>
            <?php } if (isset($module) && in_array("report", $module)) { ?>
                <li class="nav-item dropdown <?php echo $customer_report_active . $sales_report_active . $tabular_report_active; ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url("report"); ?>" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bar-chart"></i>
                        <span class="nav-label">Report</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="dropdown-menu dropdown nav-second-level" aria-labelledby="dropdown04">
                        <li class="<?php echo $tabular_report_active; ?>">
                            <a class="dropdown-item" href="<?php echo base_url("all-report"); ?>">
                                <i class="fa fa-pie-chart"></i>
                                Report
                            </a>
                        </li>
                        <li class="<?php echo $sales_report_active ?>">
                            <a class="dropdown-item" href="<?php echo base_url("report"); ?>">
                                <i class="fa fa-pie-chart"></i>
                                Salesperson Report
                            </a>
                        </li>
                        <li class="<?php echo $customer_report_active; ?>">
                            <a class="dropdown-item" href="<?php echo base_url("customer-report"); ?>">
                                <i class="fa fa-pie-chart"></i>
                                Dealer Report
                            </a>
                        </li>
                    </ul>
                </li>

            <?php } if (isset($module) && in_array("sitesetting", $module)) { ?>
                <li class="<?php echo $sitesetting_active; ?>">
                    <a href="<?php echo base_url("sitesetting"); ?>">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label">Site Setting</span>
                    </a>

                </li>

            <?php } if (isset($module) && in_array("main", $module)) { ?>
                <li class="<?php echo $mainmenu_active; ?>">
                    <a href="<?php echo base_url("main"); ?>">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label">Main Menu</span>
                    </a>
                </li>

            <?php } if (isset($module) && in_array("setting", $module)) { ?>
                <li class="nav-item dropdown <?php echo $profile_active . $change_password_active; ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url("setting"); ?>" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-gear"></i>
                        <span class="nav-label">Setting</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="dropdown-menu dropdown nav-second-level" aria-labelledby="dropdown05">
                        <?php if (isset($get_role) && $get_role != "C") { ?>
                            <li class="<?php echo $profile_active; ?>">
                                <a class="dropdown-item" href="<?php echo base_url("profile"); ?>">
                                    <i class="fa fa-gears"></i>
                                    Profile Update
                                </a>
                            </li>
                        <?php } ?>
                        <li class="<?php echo $change_password_active ?>">
                            <a class="dropdown-item" href="<?php echo base_url("update-password"); ?>">
                                <i class="fa fa-lock"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>