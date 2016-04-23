


<h2>QUESTIONNAIRE 1</h2>

<?php //echo $this->ion_auth->get_user_id();?>
<div class="row">
  <div class="">
  
 <?php echo form_open('admin/questionnaire/submit',array('class'=>'form-horziontal', 'id'=>'questionnaireform'));
   $counter = 1;
   $pagecounter = 1;
   $divisioncount = 1;

   ?>
   <div id="sf<?php echo "$divisioncount"; ?>" class="frm">
   <fieldset>
   <?php 

  foreach ($questions as $question)
    { ?>
   <div class="row">            
      <div class="form-group row">
 
        <?php echo form_label('Question No. '.$counter,'questionname', array('class'=>'control-label col-sm-2 '));?>
        <div class="col-sm-10">
          <?php echo $question->question_name;?>
        </div>
      </div>
      

      <?php echo form_hidden('question_id_'.$question->question_id, $question->question_id); ?>
 		<?php echo form_hidden('questionnaire_id', $question->questionnaire_id); ?>
     

      <?php if($question->metadescription != ''):?>
      <div class="form-group row">
        <?php echo form_label('Description','description', array('class'=>'control-label col-sm-2 '));?>
        <div class="col-sm-6">
          <?php echo $question->metadescription;?>
        </div>
      </div>
    <?php endif; ?>
    <div class="form-group row">
        <?php echo form_label('Scale','scalename', array('class'=>'control-label col-sm-2 '));?>
        <div class="col-sm-4">
          <?php echo $question->name;?>
        </div>
      </div>
     
      

      <div class="form-group row">
        <?php echo form_label('Response','response', array('class'=>'control-label col-sm-2 '));?>
        <div class="col-sm-4">
         <?php echo form_radio('responseq'.$counter, $question->key1, FALSE).$question->value1.'<br>';?>
         <?php echo form_radio('responseq'.$counter, $question->key2, FALSE).$question->value2.'<br>';?>
          <?php echo form_radio('responseq'.$counter, $question->key3, FALSE).$question->value3.'<br>';?>
          <?php echo form_radio('responseq'.$counter, $question->key4, FALSE).$question->value4.'<br>';?>
          <?php echo form_radio('responseq'.$counter,$question->key5, FALSE).$question->value5.'<br>';?>
        </div>
        <span class="text-danger"> 
          <?php echo form_error('response');?>  
        </span>
      </div>
       </div> 
       <?php 
       if($pagecounter == 10)
       { ?>


<div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <!-- back2 unique class name  -->
                <button class="btn btn-warning back<?php echo $divisioncount ?>" type="button"><span class="fa fa-arrow-left"></span> Back</button>
                <!-- open2 unique class name -->
                <button class="btn btn-primary open<?php echo $divisioncount ?>" type="button">Next <span class="fa fa-arrow-right"></span></button>
              </div>
            </div>


   <?php

        echo '</fieldset></div>';


        $divisioncount++;
         ?> 
    <div id="sf<?php echo "$divisioncount"; ?>" class="frm">
        <fieldset>
        <?php
        $pagecounter = 1;
       }
       
        $pagecounter++; 
       $counter++;
        }
          $user_id = $this->ion_auth->get_user_id();
           echo form_hidden('user_id', $user_id); 
           
           
          echo form_submit('submit', 'Submit Questions!');?>
       </fieldset>

       </div>
           
                
    <?php echo form_close();?>
    <? echo $data['users'];?>

   
  </div>
</div>
