<!--homepage-->
<script src="<?php echo $this->config->item('js_url'); ?>jquery-ui.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>tether.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>bouldercigs.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>wow.js"></script>
<input type="hidden" id="scroll-page" value="0">
<script>
    function call_animation() {
        new WOW().init();
    }
</script>