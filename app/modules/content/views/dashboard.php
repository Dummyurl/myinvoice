<?php
include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <h2 style="display: inline-block;">Statement</h2>   
        </div>
        <form id="search_form" method="get" action="<?php echo $this->config->item("site_url") . "dashboard" ?>" name="search_form" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="CustomerList">Customer</label>
                    <select class="form-control" id="CustomerList" name="CustomerList">
                        <option value="">All Customer</option>
                        <?php foreach ($customer_data as $key => $val) { ?>
                            <option <?php echo trim((int) $this->input->get('CustomerList')) == trim($val['ID']) ? "selected='selected'" : '' ?> value="<?php echo $val['ID']; ?>"><?php echo ucfirst($val['Firstname']) . " " . $val['Lastname']; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="CustomerList">Month</label>
                    <select class="form-control" id="MonthList" name="MonthList">
                        <option value="">All Month</option>
                        <?php
                        $var = 1;
                        foreach ($months as $key => $val) {
                            ?>
                            <option <?php echo trim((int) $this->input->get('MonthList')) == trim($var) ? "selected='selected'" : '' ?> value="<?php echo str_pad($var, 2, 0, STR_PAD_LEFT); ?>"><?php echo $months[$key]; ?></option>
                            <?php
                            $var++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="CustomerList">Year</label>
                    <select class="form-control" id="YearList" name="YearList">
                        <option value="">All Year</option>
                        <?php foreach ($year as $key => $val) { ?>
                            <option <?php echo trim((int) $this->input->get('YearList')) == trim($val['Year']) ? "selected='selected'" : '' ?> value="<?php echo $val['Year']; ?>"><?php echo $val['Year']; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="submit" style="margin-top: 20px;" class="btn btn-success" id="search" name="search" value="Search">Generate Statement</button>
                    <a style="margin-top: 20px;" href="<?php echo base_url(); ?>" class="btn btn-primary">Reset</a>
                    <?php if (count($invoice_data) > 0 && $deault_Search == FALSE) { ?>
                        <a style="margin-top: 20px;" target="_blank" href="<?php echo base_url(STATEMENT_PDF) . '/' . $pdf_file_name; ?>" class="btn btn-danger">PDF</a>
                    <?php } ?>
                </div>
            </div>
        </form>

        <div class="x_panel">                    
            <div class="x_content">            
                <div class="table-responsive">
                    <table id="ProvidersList" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Customer Name</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Date</th>
                                <th><?= CurrSymbol() ?> Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($invoice_data) > 0) {
                                $total_amount = 0;
                                foreach ($invoice_data as $key => $value) {
                                    $total_amount = $total_amount + $value['NetAmount'];
                                    ?>
                                    <tr id='<?php echo urlencode($this->general->encryptData($value["ID"])); ?>'>
                                        <td><?php echo "GT/" . str_pad($value['ID'], 3, 0, STR_PAD_LEFT); ?></td>                             
                                        <td><?php echo $value['CustomerName']; ?></td>                             
                                        <td><?php echo date('F', strtotime($value['CreatedOn'])); ?></td>
                                        <td><?php echo date('Y', strtotime($value['CreatedOn'])); ?></td>
                                        <td><?php echo date('M d, Y h:i A', strtotime($value['CreatedOn'])); ?></td>
                                        <td><?php echo CurrSymbol() . " " . number_format($value['NetAmount'], 2); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr style="font-size: 18px">
                                    <td colspan="5" class="text-right"><b>Total Amount</b></td>
                                    <td><b><?php echo number_format($total_amount, 2); ?></b></td>
                                </tr>
                            <?php } else { ?>
                                <tr style="font-size: 16px">
                                    <td colspan="6" class="text-center"><b>No data found</b></td>
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