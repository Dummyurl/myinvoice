<?php
include APPPATH . '/modules/views/top.php';
$cid = $this->input->get('cid');
$name = $this->input->get('name');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <h2 style="display: inline-block;">Invoice</h2>   
            <a href="<?php echo site_url("add_invoice"); ?>" class="btn btn-default btnlist float-right"> <i class="fa fa-plus"></i>&nbsp;Add Invoice</a>

        </div>
        <div class="x_panel">                    
            <div class="x_content">            
                <div class="table-responsive">
                    <table id="ProvidersList" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Customer Name</th>
                                <th><?= CurrSymbol() ?> Amount</th>
                                <th>Date</th>
                                <th width="25%">Action</th>                                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($invoice_data as $key => $value) {
                                ?>
                                <tr id='<?php echo urlencode($this->general->encryptData($value["ID"])); ?>'>
                                    <td><?php echo "GT/" . str_pad($value['ID'], 3, 0, STR_PAD_LEFT); ?></td>                             
                                    <td><?php echo $value['CustomerName']; ?></td>                             
                                    <td><?php echo CurrSymbol() . " " . number_format($value['NetAmount'], 2); ?></td>                             
                                    <td><?php echo date('M d, Y h:i A', strtotime($value['CreatedOn'])); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url() . INVOICE_PDF . $value['invoice_name']; ?>" target="_blank"  class="btn btn-primary btn-group-sm" style="background-color: #1abb9c;">
                                            <center>View Invoice</center>
                                        </a>
                                        <a href="javascript:void(0)" data-base_url="<?php echo INVOICE_PDF . $value['invoice_name']; ?>" data-url="<?php echo base_url() . INVOICE_PDF . $value['invoice_name']; ?>" onclick="SendInvoicePopup(this)" class="btn btn-primary btn-group-sm">
                                            <center>Send Invoice</center>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendinvoice" role="dialog" style="display: none; padding-left: 15px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal_header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title h4modal">Send Invoice</h4>
            </div>
            <div class="modal-body modal_header">
                <form class="form-horizontal" action="<?php echo $this->config->item("site_url") . "invoice/send_invoice" ?>" method="post" name="SendInvoiceForm" id="SendInvoiceForm"  enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" id="invoice_url" name="invoice_url" value="">
                    <div class="form-group">                        
                        <label class="control-label listlable col-xs-12">Name</label>
                        <div class="input-group col-md-6">
                            <input class="form-control" id="Name" name="Name" placeholder="Name" value="" type="text" required="">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="control-label listlable col-xs-12">Email</label>
                        <div class="input-group col-md-6">
                            <input class="form-control" id="Email" name="Email" placeholder="Email" value="" type="email" required="">
                        </div>
                    </div>

                    <div class="form-group">                        
                        <label class="control-label listlable col-xs-12">Subject</label>
                        <div class="input-group col-md-6">
                            <input class="form-control" id="Subject" placeholder="Subject" name="Subject" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">                        
                        <label class="control-label listlable col-xs-12">Message</label>
                        <div class="input-group col-md-6">
                            <textarea class="form-control"  id="Message" name="Message" required="" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <embed src="" id="invoice_path" width="400" height="275" type='application/pdf'>
                </form>
            </div>
            <div class="modal-footer btnmodal">
                <button type="button" id="SendInvoiceEmail" onclick="save_button()" class=" btnlist">Send</button>
                <button type="button" class="close btn btn-default btnlist" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>module/invoice.js"></script>
<?php include APPPATH . '/modules/views/footer.php'; ?>