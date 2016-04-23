<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Punjabdata2 extends Admin_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->model('Googleanalyticsdata_model', 'gmodel');
		
		
	}
		public function index()
	{
		
	}


	public function punjabdata()
	{
		$this->data['page_title'] = 'punjabupdate.com';

		$crud = new grocery_CRUD();
		$crud->set_table('newpunjab2');
		$crud->set_subject('punjabdata');
		
		 $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();
		
		
		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
 
		
}