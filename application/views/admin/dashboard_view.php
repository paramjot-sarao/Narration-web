<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $user_role = $this->ion_auth->get_users_groups()->row()->name;




?>

<div class="row">
	<div class="col-lg-12">
		<h2>Welcome to the <?php echo ucfirst($user_role);?> Panel</h2>
	<?php 
	
		if($user_role  == 'admin')
		{/*
			echo '<pre>';
		 	
		 	print_r($report);
		 	echo '</pre>';	*/
		 	if(!empty($finaldata)){
		 		echo '<pre>';
			 	print_r($finaldata);
			 	echo '</pre>';
		 	}
		}

		?>
	</div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

