
<table class = "table table-striped">
	<thead>
	<tr>
		<th> Number of raters:</th> </tr></thead>		
	<tbody>
	<tr>
		<td> <?php echo $rater; ?></td>
		
		</tr></tbody>		
</table>
<table class = "table table-striped">
	<thead>
	<tr><th> Number of questions:</th></tr>
	</thead>
	<tbody>
	<tr><td> <?php echo $question; ?></td></tr>
	</tbody>
</table>
<table class = "table table-striped">
	<thead>
	<tr><th> Values of P_j according to Fleiss kappa:</th></tr>
	</thead>
	<tbody>
	<?php 
	$count = 1;
	foreach ($columnsum as $val) { ?>
		<tr>
			<td><?php echo "Sum of "." ".$count." "."column:"." ".$val['sum'];?></td>	
			
		</tr>
		<?php 
		$count++;
		} ?>
	</tbody>
</table>

<table class = "table table-striped">
	<thead>
	<tr><th> Values of P_i according to Fleiss kappa:</th></tr>
	</thead>
	<tbody>
	<?php 
	$count = 1;
	foreach ($rowsum as $val) { ?>
		<tr>
			<td><?php echo "Sum of "." ".$count." "."row:"." ".$val;?></td>			
		</tr>
		<?php 
		$count++;
		} ?>
	</tbody>
</table>
<table class = "table table-striped">
	<thead>
	<tr>
		<th> Value of Pbar:</th> </tr>	</thead>	
	<tbody>
	<tr>
		<td> <?php echo $pbar; ?></td>
		
		</tr></tbody>		
</table>
<table class = "table table-striped">
	<thead>
	<tr>
		<th> Value of Pebar:</th> </tr>		</thead>
	<tbody>
	<tr>
		<td> <?php echo $pebar; ?></td>
		
		</tr></tbody>		
</table>
<table class = "table table-striped">
	<thead>
	<tr>
		<th> Final degree of agreement or Kappa value:</th> </tr>	</thead>	
	<tbody>
	<tr>
		<td> <?php echo $k; ?></td>
		
		</tr></tbody>
		
</table>



	