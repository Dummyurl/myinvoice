<?php
include APPPATH . '/modules/views/top.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <h2 style="display: inline-block;">Customer</h2>   
            <a href="<?php echo base_url() . "add_customer/"; ?>" class="btn btn-default btnlist float-right"> <i class="fa fa-plus"></i>&nbsp;Add Customer</a>
        </div>
        <div class="x_panel">                    
            <div class="x_content">            
                <div class="table-responsive">
                    <table id="ProvidersList" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SrNo.</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>GST No</th>
                                <th>Address</th>
                                <th width="15%">Action</th>                                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($invoice_data as $key => $value) {
                                ?>
                                <tr id='<?php echo urlencode($this->general->encryptData($value["ID"])); ?>'>
                                    <td><?php echo $i; ?></td>                             
                                    <td><?php echo ucfirst($value['Firstname']) . " " . ucfirst($value['Lastname']); ?></td>                             
                                    <td><?php echo $value['Phone']; ?></td>                             
                                    <td><?php echo $value['GSTno']; ?></td>                             
                                    <td><?php echo $value['Address']; ?></td>                             
                                    <td class="text-center">
                                        <a href="<?php echo base_url() . "edit_customer?id=" . $value["ID"]; ?>"  class="btn btn-primary btn-group-sm" style="background-color: #1abb9c;">
                                            <center>Update</center>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
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