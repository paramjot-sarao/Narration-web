 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title;?></title>

 <link href="<?php echo site_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
<?php
    // Grocery CRUD scripts
    if ( !empty($output) )
    {
      foreach ($output->css_files as $file)
        echo "<link href='$file' rel='stylesheet'>".PHP_EOL;
    }
  ?>
</head>
<body>
	

 <?php $this->load->view($view); ?>


    <?php
		// Grocery CRUD scripts
		if ( !empty($output) )
		{
			
			foreach ($output->js_files as $file)
				echo "<script src='$file'></script>".PHP_EOL;
		}
	?>
	</body>
	</html>