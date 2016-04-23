<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Narrationmetrics extends Admin_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->library('grocery_CRUD');
		
		
	}
		public function index()
	{
		
	}

	/*public function narration_metrics()
	{
		$this->data['page_title'] = 'Metrics ';

		$crud = new grocery_CRUD();
		$crud->set_table('metrics');
		$crud->set_subject('narration metrics');
		
		//$crud->set_relation('id_punjab','googleanalyticsdata','id_punjab');	

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}*/

	public function metrics()
	{
		$this->load->model('Narrationmetrics_model', 'metrics');
		
		$this->data['narration'] = $this->metrics->narrationmetrics();
	
		$this->render('admin/narration_view');
	}

}