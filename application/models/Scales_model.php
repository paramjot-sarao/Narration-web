<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Scales_model extends MY_Model
{

	public function __construct()
	{
        $this->table = 'scales';
        $this->primary_key = 'scale_id';
       

     // $this->has_many['question'] = array('Questionnaire_model','scale_id');
        //$this->has_many['questions'] = array('foreign_model'=>'Question_model','foreign_table'=>'questions',
               // 'local_key'=> 'scale_id');

       
      $this->has_many['question'] = 'Question_model';

		parent::__construct();
	}

    
	

}