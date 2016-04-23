<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container-fluid" style="padding: 20px 0px; margin: 0 -10px">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-primary">Create user</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if(!empty($users))
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Username</td></td><td>Name</td><td>Email</td><td>Last login</td><td>Operations</td></tr>';
      foreach($users as $user)
      {
        echo '<tr>';
        echo '<td>'.$user->id.'</td><td>'.$user->username.'</td><td>'.$user->first_name.' '.$user->last_name.'</td></td><td>'.$user->email.'</td><td>';
        if($user->last_login != NULL):
          echo date('Y-m-d H:i:s', $user->last_login);'</td><td>';
        else:
          echo 'Not Logged in yet. </td><td>';
        endif;
        if($current_user->id != $user->id) echo anchor('admin/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>').' '.anchor('admin/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>');
        else echo '&nbsp;';
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
    </div>
  </div>
</div>