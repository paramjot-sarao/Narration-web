
<table class = "bordred stripped " >
<thead>
<tr>
<td>Name</td>
<td>Email</td>
</tr>
</thead>
<tbody>

<?php

foreach($users as $user)
{
?>
 <tr>
 <td><?php echo $user->first_name.' '.$user->last_name;?></td>
    <td><?php echo $user->email;?></td>
   
 </tr>
<?php
}
?>
</tbody>
</table>
<?php
//var_dump($users);
?>