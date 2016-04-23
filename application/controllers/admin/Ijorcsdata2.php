<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ijorcsdata2 extends Admin_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->model('Ijorcsanalyticsdata_model', 'gmodel');
		$this->load->model('Ijorcsanalyticsdata2_model', 'pmodel');

		
		
	}
		public function index()
	{
		
	}


	public function ijorcsdata()
	{
		$this->data['page_title'] = 'ijorcs.org';

		$crud = new grocery_CRUD();
		$crud->set_table('newijorcs2');
		$crud->set_subject('Ijorcsdata');
		
		$crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
	

}