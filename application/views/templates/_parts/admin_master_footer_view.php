<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
    <script src="<?php echo site_url('assets/sbadmin/bower_components/jquery/dist/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/dist/js/sb-admin-2.js');?>"></script>
    <script src="<?php echo site_url('assets/sbadmin/js/jquery.validate.min.js');?>"></script>
    <script src="<?php echo site_url('assets/sbadmin/dist/js/jquery-ui.js');?>"></script> 
    <script src="<?php echo site_url('assets/sbadmin/dist/js/printThis.js');?>"></script> 
    <script src="<?php echo site_url('assets/sbadmin/js/admin.js');?>"></script> 

   

    <?php
		// Grocery CRUD scripts
		if ( !empty($output) )
		{
			
			foreach ($output->js_files as $file)
				echo "<script src='$file'></script>".PHP_EOL;
		}
	?>
	

<?php echo $before_body;?>
</body>
</html>