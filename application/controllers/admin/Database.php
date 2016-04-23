<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		//$this->load->database();
		//$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}

	public function index()
	{
		
	}



	public function conditions()
	{
		$this->data['page_title'] = 'Conditions';

		$crud = new grocery_CRUD();
		$crud->set_table('conditions');
		$crud->set_subject('condition');
		
		$crud->set_relation('rule_id','rules','rule_name');	

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function narrationdetails()
	{
		$this->data['page_title'] = 'Narration Details';

		$crud = new grocery_CRUD();
		$crud->set_table('narration_details');
		$crud->set_subject('Narration Detail');

		$crud->set_relation('condition_id','conditions','condition_name');
		$crud->set_relation('narrativetype_id','narrativetype_details','narrative_type');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function narrationtitles()
	{
		$this->data['page_title'] = 'Narration Titles';

		$crud = new grocery_CRUD();
		$crud->set_table('narration_titles');
		$crud->set_subject('Narration Title');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function narrativetypedetails()
	{

		$this->data['page_title'] = 'Narrativetype Details';

		$crud = new grocery_CRUD();
		$crud->set_table('narrativetype_details');
		$crud->set_subject('Narrativetype Detail');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function rules()
	{
		$this->data['page_title'] = 'Rules';

		$crud = new grocery_CRUD();
		$crud->set_table('rules');
		$crud->set_subject('rule');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
	public function ruleset()
	{
		$this->data['page_title'] = 'Rulesets';

		$crud = new grocery_CRUD();
		$crud->set_table('ruleset');
		$crud->set_subject('ruleset');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function sectiondetails()
	{
		$this->data['page_title'] = 'Section Details';

		$crud = new grocery_CRUD();
		$crud->set_table('section_details');
		$crud->set_subject('Section Details');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
	
}



