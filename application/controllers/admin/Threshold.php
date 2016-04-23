<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Threshold extends Admin_Controller 
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('NarrationEngine');
	}

	public function index()
	{
		
		$this->data['page_title'] = 'Report';
	    if($this->input->post())
	    {
	      $this->load->library('form_validation');

	      $this->form_validation->set_rules('enddate', 'Enddate', 'required');
	      $this->form_validation->set_rules('website', 'Website', 'required');
	      //$this->form_validation->set_rules('remember','Remember me','integer');
	      if($this->form_validation->run()===TRUE)
	      {
	      	$this->load->model('Threshold_model', 'tmodel');
	      	$this->load->model('Threshold2_model', 'pmodel');
	     
	     	$enddate = $this->input->post('enddate');
	      		      	
	      	$startdate = date('Y-m-d',strtotime("$enddate -1 week"));
	      	$table = $this->input->post('website');

	      	
	      	//...calculate threshold of current data
	      $this->data['current_the'] = $this->tmodel->current_threshold($startdate,$enddate,$table); 
	      

	      	//....calculate threshold of historic data
	      	$date = $this->db->select('date')
	      				->from('newpunjab')
	      				->order_by("date","asc")
	      				->get()->result_array();
	      	
	      	$first = reset($date);
	      	
	      	
    		$last = end($date);
    		
    		
    		//$first = date('Y-m-d',strtotime("$date1 -60 days"));
    		
    		
    		$this->data['history_the'] = $this->tmodel->historic_threshold($first['date'],$last['date'],$table);
	   		
 		   	
	   		
	   		$this->data['validated'] = true;

	   		
   		
	    }
	  }

	    $this->load->helper('form');
	    $this->render('admin/threshold_view');
	}
	
	


}