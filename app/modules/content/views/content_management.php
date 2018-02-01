<?php
include APPPATH . '/modules/views/top.php';
$cid = $this->input->get('cid');
$name = $this->input->get('name');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <h2 style="display: inline-block;">Content Management</h2>
<!--            <a href="<?php echo base_url('add_content'); ?>" class="btn btn-default btnlist float-right" ><i class="fa fa-plus"></i>&nbsp; New Content</a>-->
        </div>
        <div class="x_panel">                    
            <div class="x_content">            
                <div class="table-responsive">
                    <table id="ContentList" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Created Date</th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($content_data)) {
                                foreach ($content_data as $key => $value) {
                                    ?>
                                    <tr id='<?php echo urlencode($this->general->encryptData($value["id"])); ?>'>
                                        <td><?php echo $value['page']; ?></td>                             
                                        <td><?php echo date('M d, Y h:m A', strtotime($value['created_on'])); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td  colspan='4' class='text-center'>No content data found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function (e) {
        $('#ContentList tbody').on('click', 'tr td:not(:last-child)', function () {
            var id = $(this).parent("tr").attr("id");
            var url = "<?php echo $this->config->item("site_url") . "update_content?id="; ?>" + id;
            window.location.href = url;
        });
    });

    function deleteContent($this) {
        var baseurl = '<?php echo base_url(); ?>';
        var id = $($this).attr("data-id");

        bootbox.confirm({
            message: "Are you sure? you want to delete this.",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: baseurl + "content/deleteContent",
                        type: "POST",
                        data: {id: id},
                        beforeSend: function () {
                            $('#loadingmessage').show();
                        },
                        success: function (data) {
                            $('#loadingmessage').hide();
                            if (data == true) {
                                window.location.reload();
                            } else {
                                bootbox.alert("Unable to delete content.Please try again.");
                                return false;
                            }
                        }
                    });
                }

            }
        });


    }
</script>
<?php
include APPPATH . '/modules/views/footer.php';
?>