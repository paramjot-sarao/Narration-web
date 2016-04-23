<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Admin_Controller 
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
	      	$this->load->model('Websitereports_model', 'rmodel');
	      	$this->load->model('Threshold_model', 'tmodel');
	      	$this->load->model('Threshold2_model', 'pmodel');
	      	//$this->load->model('Reportstructure_model', 'report');
	     
	     	$enddate = $this->input->post('enddate');
	      
	      	
	      	$startdate = date('Y-m-d',strtotime("$enddate -1 week"));
	      	$table = $this->input->post('website');
	      	$this->data['table'] =  $this->input->post('website');
	    //...calculate threshold of current data
	      	$this->data['current_the'] = $this->tmodel->current_threshold($startdate,$enddate,$table); 
	      	$this->data['current_week'] = $this->rmodel->current_week($startdate,$enddate,$table);
	    

	      	
	      	$date = $this->db->select('date')
	      				->from('newpunjab')
	      				->order_by("date","asc")
	      				->get()->result_array();
	      	
	      	$first = reset($date);	      
	     	$last = end($date);	     
    		$this->data['history_the'] = $this->tmodel->historic_threshold($first['date'],$last['date'],$table);	     
	   		//...calculate date bounds
	   		$this->data['datebounds'] = $this->narrationengine->newcalculatedatebounds($startdate,$enddate);	
	   		
	      	$this->data['previous_week'] = $this->rmodel->previous_week($this->data['datebounds']['lastweek_startdate'],  $this->data['datebounds']['lastweek_enddate'],$table);	
	      

	    	$this->data['rateofchange'] = $this->narrationengine->Rateofchange($this->data['current_week'],$this->data['previous_week']);
  		  

  		  	$this->data['get_narration'] = $this->pmodel->getnarration($this->data['current_the'],$this->data['history_the'],$this->data['rateofchange']); 	 	
	   		//...fetch narration
	   		$this->data['fetch_narration'] = $this->pmodel->fetch($this->data['get_narration']);
	   		

	    	$this->data['validated'] = true;
	    }
	  }

	    $this->load->helper('form');
	    $this->render('admin/report_view');
	}

	
	
	

}