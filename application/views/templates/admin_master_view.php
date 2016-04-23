<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('templates/_parts/admin_master_header_view'); ?>

<div id="page-wrapper" style="padding-top: 20px;">
        <?php echo $the_view_content; ?>
</div>

<?php $this->load->view('templates/_parts/admin_master_footer_view');?>