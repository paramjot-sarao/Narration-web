<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionnaire extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		
		$this->load->model('Question_model', 'qmodel');
		$this->load->helper('form');
	}

	public function index()
	{
		//$questions = $this->qmodel->with_question()->with_scale()->get(2);
		$this->load->library('ion_auth');
		$this->data['questions'] = $this->qmodel->get_questions();
		//$data1 = $this->qmodel->get_questions();
		//var_dump($data1);
		$this->render('admin/questionnaire_view');	
	}


	public function submit()
	{
		$result = $_POST;
		$rowss = array();

		for($i = 0; $i < 93; $i++) {
			$c = $i +1;
		
			$rowss[$c] = array('question_id' => $result['question_id_'.$c],
				'response' => $result['response'.$c],
				'user_id' => $result['user_id'],
				'questionnaire_id' => $result['questionnaire_id']
				
				);
			}
		
		$this->db->insert_batch('response', $rowss); 

		//redirect('admin/questionnaire', 'refresh');
		$one = $this->qmodel->get_id();
   		$one = $one[0];
 		$pp = $this->qmodel->qfd_one($one);
 		
 		$qfd = $pp;

 		   		$this->db->select('*');
                $this->db->from('qfdone');
          $row_count = $this->db->count_all_results();
 		
 		if($row_count == 0)
 		{
 			$this->db->insert_batch('qfdone', $qfd); 
 		}
 		else
 		{

		$this->db->update_batch('qfdone', $qfd, 'question_id'); 
	 	}
		
		$this->render('admin/questionnairesubmit_view');	
	}


public function qfd()
{
	
	$rater = $this->qmodel->count_user();
	
	$question = $this->qmodel->questions_count();

 	$columnsum = $this->qmodel->qfd_column_sum();
 //var_dump($columnsum);
 	$rowsum = $this->qmodel->qfd_rows_sum();
 	//var_dump($rowsum);
	$p_j = $this->qmodel->p_j($columnsum,$rater,$question);
	
 	
	$p_i = $this->qmodel->p_i($rowsum,$rater);
 	 
 	$pbar = $this->qmodel->pbar($p_i,$question); 	
 		
	$pebar = $this->qmodel->pe_bar($p_j);	
		
	$k = $this->qmodel->final_value($pbar,$pebar);
	
	$this->data['rater'] = $rater;
	$this->data['question']= $question;
	$this->data['columnsum']= $columnsum;
	$this->data['rowsum']= $rowsum;
	$this->data['p_j']= $p_j;
	$this->data['p_i']= $p_i;
	$this->data['pbar']= $pbar;
	$this->data['pebar'] = $pebar;
	$this->data['k']= $k;
	$this->render('admin/kappa_view');
}

}

