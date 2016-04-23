<table class = "table table-striped">
<thead>
	<tr>
	<th>Average of all columns:</th>
	</tr>
</thead>
<tbody>
	<?php 
	$count = 1;
	foreach ($average as $val) { ?>
		<tr>
			<td><?php echo "Average of "." ".$count." "."column:"." ".$val;?></td>			
		</tr>
		<?php 
		$count++;
		} ?>
	
</tbody>
</table>
<table class = "table table-striped">
<thead>
	<tr>
	<th>Standard deviation of all columns:</th>
	</tr>
</thead>
<tbody>
	<?php 
	$count = 1;
	foreach ($deviation as $val) { ?>
		<tr>
			<td><?php echo "Standard deviation of "." ".$count." "."column:"." ".$val;?></td>			
		</tr>
		<?php 
		$count++;
		} ?>
	
</tbody>
</table>
<table class = "table table-striped">
<thead>
	<tr>
	<th>Final cutt-off values of all columns:</th>
	</tr>
</thead>
<tbody>
	<?php 
	$count = 1;
	foreach ($cutt as $val) { ?>
		<tr>
			<td><?php echo "Final cutt-off value of "." ".$count." "."column:"." ".$val;?></td>			
		</tr>
		<?php 
		$count++;
		} ?>
</tbody>
</table>