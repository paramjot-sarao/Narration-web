<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <h1>Create New User</h1>
      <?php echo form_open('',array('class'=>''));?>
      <div class="form-group">
        <?php
        echo form_label('First name','first_name');
        echo form_error('first_name', '<div class="alert alert-danger">', '</div>');
        echo form_input('first_name',set_value('first_name'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Last name','last_name');
        echo form_error('last_name', '<div class="alert alert-danger">', '</div>');
        echo form_input('last_name',set_value('last_name'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Company','company');
        echo form_error('company', '<div class="alert alert-danger">', '</div>');
        echo form_input('company',set_value('company'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Phone','phone');
        echo form_error('phone', '<div class="alert alert-danger">', '</div>');
        echo form_input('phone',set_value('phone'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Username','username');
        echo form_error('username', '<div class="alert alert-danger">', '</div>');
        echo form_input('username',set_value('username'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Email','email');
        echo form_error('email', '<div class="alert alert-danger">', '</div>');
        echo form_input('email','','class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Password','password');
        echo form_error('password', '<div class="alert alert-danger">', '</div>');
        echo form_password('password','','class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Confirm password','password_confirm');
        echo form_error('password_confirm', '<div class="alert alert-danger">', '</div>');
        echo form_password('password_confirm','','class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        if(isset($groups))
        {
          echo form_label('Groups','groups[]');
          foreach($groups as $group)
          {
            echo '<div class="checkbox">';
            echo '<label>';
            echo form_checkbox('groups[]', $group->id, set_checkbox('groups[]', $group->id));
            echo ' '.$group->name;
            echo '</label>';
            echo '</div>';
          }
        }
        ?>
      </div>
      <?php echo form_submit('submit', 'Create user', 'class="btn btn-primary btn-lg"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
<br/><br/><br/>