<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php 
$final = array('info','danger','success','primary','warning','default');
?>
<div>
<h3>
<p class="text-center">
<?php echo "Narration Metrics";?> </p></h3>
<p class="text-justify">
<?php echo "Following metrics are used in automatic narration generation.";?> </p> 
</div>
<?php
foreach($narration as $val)
	{
		$random = array_rand($final);
		
echo '<div>';?>
<div class= "panel-body">
	<h4>
		<?php echo ucwords(str_replace("_"," ",$val['name']));?> 
	</h4>
	<div class= "panel-info">
		<?php
		if($val['formula'] == NULL)
		{
			unset($val['formula']);
		}
		else
		{ ?>
		<dl class="dl-horizontal">
			<dt>Formula:</dt>
			<dd><?php echo $val['formula']; ?></dd>
		</dl>	
		<?php }		?>
		<dl class="dl-horizontal">
			<dt>Definition:</dt>
			<dd><?php echo $val['description'];?></dd>
		</dl>	
			
	</div>
</div>
</div>
<?php 

}

?>

