<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div>
    <?php $site = $this->config->item('site');
          $sname = $site['short_name'];
            //  var_dump($menu); ?>
    
    <?php echo '<div class="error">';
          echo $this->session->flashdata('message', $this->ion_auth->messages());
          echo '</div>';?>
    <?php echo form_open('admin/threshold',array('class'=>'form-inline'));?>
      <div class="form-group">
       <?php $options = array(
                'newpunjab,newpunjab2'  => 'Punjabupdate website',
                'newijorcs,newijorcs2' =>  'Ijorcs website'                 
                );?>

        <?php echo form_label('Website','website');?>
        <?php echo form_dropdown('website',$options);?>
      
      
        <div class="form-group">
    
        <?php echo form_label('Start Date','enddate');?>
        <?php echo form_error('enddate');?>
        <?php 
       
        if($_POST) 
            {
                echo form_input('enddate',$_POST['enddate'],'class="form-control" id="end_date"');
            }
        else
            {
                
                echo form_input('enddate','','class="form-control" id="end_date"');
            }
        ?>
        </div> 
        <div class="form-group">
        
        <?php
       
        if($_POST) 
            {   echo form_label('End Date','startdate');
                echo form_error('startdate');
                $startdate1 = $_POST['enddate'];
                $startdate = date('Y-m-d',strtotime("$startdate1 -1 week"));
                echo form_input('startdate',$startdate,'class="form-control" disabled="disabled"');
            }
        else
            {
                
                //echo form_input('startdate','','class="form-control" disabled="disabled"');
            }
        ?>
        </div> 
     
        <div class="form-group">     
      <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-md btn-block"');?>
     </div>
       </div>
    <?php echo form_close();?>

    
  </div>
</div>


<?php
    if (isset ($validated))
    {
        if($validated == true)
        {
            echo "current data threshold";
            echo'<pre>';
            print_r($current_the);
            echo '</pre>';
            echo "historic data threshold";
            echo'<pre>';
            print_r($history_the);
            echo '</pre>';
           
           
           

        }
    }
    ?>
