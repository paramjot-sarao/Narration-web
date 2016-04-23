<table class = "table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			
			<th>Email </th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo $user->first_name.' '.$user->last_name;?></td>
			
			<td> <?php echo $user->email; ?>
			</td>
		</tr>
		<?php 
		} ?>
	</tbody>
</table>
<thead>




