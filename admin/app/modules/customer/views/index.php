<?php
include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <h2 style="display: inline-block;">Manage Customer</h2>   
        </div>
        <div class="x_panel">                    
            <div class="x_content">            
                <div class="table-responsive">
                    <table id="ProvidersList" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($customer_data) > 0) {
                                $i = 1;
                                foreach ($customer_data as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>                             
                                        <td><?php echo ucfirst($value['Firstname']) . " " . ucfirst($value['Lastname']); ?></td>                             
                                        <td><?php echo $value['Email']; ?></td>
                                        <td><?php echo $value['Phone']; ?></td>
                                        <td><?php echo date('M-d-Y h:i:s', strtotime($value['CreatedOn'])); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr style="font-size: 16px">
                                    <td colspan="5" class="text-center"><b>No data found</b></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH . '/modules/views/footer.php'; ?>