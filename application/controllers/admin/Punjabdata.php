<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Punjabdata extends Admin_Controller {

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
		$crud->set_table('newpunjab');
		$crud->set_subject('punjabdata');
		 $crud->callback_column('landingPagePath', array($this,'full_text'));
		 $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();
		
		//$crud->set_relation('parent_id','autogeneratetree','nodename');	

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
 public function full_text($value,$row)
    {

      return $value = wordwrap($row->landingPagePath, 50, "<br>", true);

    }

		
}