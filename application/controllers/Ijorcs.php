<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ijorcs extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }


	public function index()
	{
		
		$data['page_title'] = 'Report';
	   
	    $this->load->model('Websitereports_model', 'rmodel');
	    $this->load->model('Threshold_model', 'tmodel');
	    $this->load->model('Threshold2_model', 'pmodel');
	       
	    $enddate1 = date('Y-m-d',strtotime("now"));
	    $enddate = date('Y-m-d',strtotime("$enddate1 -1 day"));
	      
	      	
	    $startdate = date('Y-m-d',strtotime("$enddate -1 week"));
	    $table = 'newijorcs,newijorcs2';
	    $data['table'] = 'newijorcs,newijorcs2';
	    //...calculate threshold of current data
	    $data['current_the'] = $this->tmodel->current_threshold($startdate,$enddate,$table); 
	    $data['current_week'] = $this->rmodel->current_week($startdate,$enddate,$table);
	    $date = $this->db->select('date')
	      				->from('newpunjab')
	      				->order_by("date","asc")
	      				->get()->result_array();
	      	
	    $first = reset($date);	      
	    $last = end($date);	     
    	$data['history_the'] = $this->tmodel->historic_threshold($first['date'],$last['date'],$table);	     
	   		//...calculate date bounds
	   	$data['datebounds'] = $this->narrationengine->newcalculatedatebounds($startdate,$enddate);

	    $data['previous_week'] = $this->rmodel->previous_week($data['datebounds']['lastweek_startdate'],  
	    $data['datebounds']['lastweek_enddate'],$table);	
	      	
	    $data['rateofchange'] = $this->narrationengine->Rateofchange($data['current_week'],$data['previous_week']);
	 	$data['get_narration'] = $this->pmodel->getnarration($data['current_the'],$data['history_the'],$data['rateofchange']); 	 	
	   		//...fetch narration
	   	$data['fetch_narration'] = $this->pmodel->fetch($data['get_narration']);
	   		
	    $data['view'] = 'front/ijorcs_view';        

        $this->load->view('front/index', $data);
	  
	    }	

}