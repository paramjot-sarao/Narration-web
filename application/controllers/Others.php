<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Others  extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		//$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

 



 


//alertmessages

public function acknowledgements()
	{		
			$this->data['page_title'] = 'Acknowledgements';
		
			$crud = new grocery_CRUD();
			$crud->set_table('acknowledgements');
			$crud->set_subject('Acknowledgements');
			$crud->required_fields('AcknowledgementText');
		    
		    $crud->fields('AcknowledgementText');
			$crud->field_type('LastUpdate', 'hidden');
			$this->data['output'] = $crud->render();
			$this->render('admin/crud_view');

	}




//ddosscripts

public function credits()
	{
			$this->data['page_title'] = 'Credits';
		
			$crud = new grocery_CRUD();
			$crud->set_table('credits');
			$crud->set_subject('Credits ');
			$crud->required_fields('CreditLink'.'CreditDetails');
			$crud->fields('CreditDetails');
			$crud->field_type('LastUpdate', 'hidden');
			$this->data['output'] = $crud->render();
			$this->render('admin/crud_view');

	}


public function reference()
	{
			$this->data['page_title'] = 'Reference';
		
			$crud = new grocery_CRUD();
			$crud->set_table('reference');
			$crud->set_subject('References ');
			$crud->fields('ReferenceTitle','ReferenceLink','WhyThisLink');
			$crud->required_fields('ReferenceTitle'.'ReferenceLink');
			$crud->field_type('LastUpdate', 'hidden');
			$this->data['output'] = $crud->render();
			$this->render('admin/crud_view');

	}

 

 
	 

	 


//resources

public function resources()
	{
			$this->data['page_title'] = 'Resources';
			
			$crud = new grocery_CRUD();
			$crud->set_table('resources');
			$crud->set_subject('Resources ');
			$crud->fields('ResourceType','ResourceTitle','ResourceDetail');
			$crud->required_fields('ResourceType','ResourceTitle', 'ResourceTitle');
			$crud->field_type('LastUpdate', 'hidden');
		 	$this->data['output'] = $crud->render();
			$this->render('admin/crud_view');
	}



	
 //publication
	
	 

 public function publication()
	{
			$this->data['page_title'] = 'Publication';
			
			$crud = new grocery_CRUD();
			$crud->set_table('publication');
			$crud->set_subject('Publications ');
			$crud->required_fields('PublicationTitle', 'PublicationDate'.'PublicationLink');
			$crud->field_type('LastUpdate', 'hidden');
		 	$this->data['output'] = $crud->render();
			$this->render('admin/crud_view');
	}


	 


}



