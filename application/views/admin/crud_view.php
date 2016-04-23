<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
	<div class="col-lg-12">
		<h2>
		<?php echo $page_title; 

		/*if(strpos($this->uri->uri_string(), 'read')):
		switch ($crud_type) {
			case 'performaa':
				echo '<a href="'.site_url('admin/forms/performaa_receipt/read').'/'.$this->uri->segment($this->uri->total_segments()).'" class="btn btn-primary pull-right">View Receipt</a>';
				break;
			
			default:
				# code...
				break;
		}
		endif; */
		?>		
		</h1>
		<?php 
		echo $output->output; ?>
	</div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
	