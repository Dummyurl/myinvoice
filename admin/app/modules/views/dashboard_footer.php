</div>
<div class="modal fade" id="select-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="SelectCategoryForm" name="SelectCategoryForm" method="post">
                <input type="hidden" id="record_id"/>
                <div class="modal-header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" style="font-size: 18px;">Category Selection</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Please select one category</p>
                    <?php
                    if (isset($Product_Category) && !empty($Product_Category)) {
                        $ci = 0;
                        foreach ($Product_Category as $row) {
                            if (strtolower($row['Title']) != "accessories") {
                                if ($ci % 2 == 0) {
                                    echo '<div class="row">';
                                }
                                ?> 
                                <div class="col-md-6">
                                    <label class="category_box text-center">
                                        <a href="<?php echo base_url("create-product?cid=" . $row['ID']); ?>" class="category_box_text">

                                            <?php echo ucfirst($row['Title']); ?>

                                        </a>
                                    </label>
                                </div>
                                <?php
                                $ci++;
                                if ($ci % 2 == 0) {
                                    echo '</div>';
                                } elseif (count($Product_Category) == $ci) {
                                    echo '</div>';
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="footer">
    <div>
        <strong>&copy;</strong> <?php echo MY_SITE_NAME . " " . date("Y"); ?>
    </div>
</div>
<?php include APPPATH . '/modules/views/dashboard_js.php'; ?>
</body>
</html>