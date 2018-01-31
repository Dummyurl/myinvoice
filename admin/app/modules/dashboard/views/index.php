<?php
include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">                    
            <div class="x_content">            
                <div class="col-lg-4 dashboard-widget" style="margin-left: 10px">
                    <div class="dashboard-widget-title text-center" style="padding-left: 0;">
                        <h4>User</h4>
                    </div>
                    <div class="dashboard-widget-content">
                        <h1 class="no-margins"><span class="pull-left" style="padding-left: 12px;"><?php echo $total_user; ?></span></h1>
                        <a class="change_font btn btn-info pull-right"  href="<?php echo base_url("user"); ?>">Manage User</a>
                    </div>
                </div>
                <div class="col-lg-4 dashboard-widget" style="margin-left: 10px">
                    <div class="dashboard-widget-title text-center" style="padding-left: 0;">
                        <h4>Customer</h4>
                    </div>
                    <div class="dashboard-widget-content">
                        <h1 class="no-margins"><span class="pull-left" style="padding-left: 12px;"><?php echo $total_customer; ?></span></h1>
                        <a class="change_font btn btn-info pull-right"  href="<?php echo base_url("customer"); ?>">Manage Customer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH . '/modules/views/footer.php'; ?>