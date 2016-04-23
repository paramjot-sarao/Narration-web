<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionnaires extends Admin_Controller 
{

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
	public function scales()
	{
		$this->data['page_title'] = 'Scales';

		$crud = new grocery_CRUD();
		$crud->set_table('scales');
		$crud->set_subject('scales');
     $crud->unset_edit()
         ->unset_delete()
         ->unset_read();

		
		//$crud->set_relation('scale_id','scale_name','scale_value');	for foreign key

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	Public function questions()
	{
		$this->data['page_title'] = 'Questions';

		$crud = new grocery_CRUD();
		$crud->set_table('questions');
		$crud->set_subject('Questions');
		$crud->fields('question_name','metadescription','created_at','updated_at','scale_id', 'group','questionnaire_id');

		$crud->set_relation('scale_id','scales','name');

		$crud->set_relation('questionnaire_id','questionnaireone','questionnaire_name');//for foreign key
     $crud->unset_edit()
         ->unset_delete()
         ->unset_read();


		 $crud->field_type('created_at', 'hidden');
		 $crud->field_type('updated_at', 'hidden');
		 $crud->unset_texteditor('question_name','full_text');
		  $crud->unset_texteditor('metadescription','full_text');

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}

	public function responsetable()
	{
		$this->data['page_title'] = 'Response Table';

		$crud = new grocery_CRUD();
		$crud->set_table('response');
		$crud->set_subject('Response_table');
    $crud->set_relation('question_id','questions','{question_id}-{question_name}');
    $crud->set_relation('questionnaire_id','questionnaireone','questionnaire_name');
    $crud->set_relation('user_id','users','{first_name}-{last_name}');
    //$crud->set_relation('response','qfdone','value');

  $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
	
public function questionnairesone()
	{
		$this->data['page_title'] = 'Questionnaire';

		$crud = new grocery_CRUD();
		$crud->set_table('questionnaireone');
		$crud->set_subject('questionnaires');
		$this->data['output'] = $crud->render();
		$this->render('admin/crud_view');
	}
	public function users()
  {
        $this->load->library('Ion_auth');
      	$users = $this->ion_auth->users(2)->result();

       foreach ($users as $user) {
              unset($user->id);
              unset($user->user_id);
              unset($user->ip_address);
              unset($user->username);
              unset($user->password);
              unset($user->salt);
              unset($user->activation_code);
              unset($user->forgotten_password_code);
              unset($user->forgotten_password_time);
              unset($user->remember_code);
              unset($user->created_on);
              unset($user->last_login);
              unset($user->active);
              unset($user->company);
              unset($user->phone);
       }
       $this->data['users'] = $users;
       $this->render('admin/users_view');

  }

  public function responses()
  {
    
        $this->data['page_title'] = 'Final Responses';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('qfdone');
        $crud->set_subject('qfdone_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
        $crud->callback_column('Scale rating value1',array($this,'Scaleratingvalues'));
        $crud->callback_column('Scale rating value2',array($this,'Scaleratingvalues'));
        $crud->callback_column('Scale rating value3',array($this,'Scaleratingvalues'));
        $crud->callback_column('Scale rating value4',array($this,'Scaleratingvalues'));
        $crud->callback_column('Scale rating value5',array($this,'Scaleratingvalues'));
      	$crud->unset_columns('questionnaire_id');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $this->data['output']= $crud->render();
    $this->render('admin/crud_view');
    }
    public function priority()
  	{
     
        $this->data['page_title'] = 'All Questions Precedence';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('precedence');
        $crud->set_subject('precedence_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
        $crud->unset_columns('questionnaire_id');
        $crud->display_as('pj1','Column 1 precedence');
        $crud->display_as('pj2','Column 2 precedence');
        $crud->display_as('pj3','Column 3 precedence');
        $crud->display_as('pj4','Column 4 precedence');
        $crud->display_as('pj5','Column 5 precedence');
        $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();
 		
    $this->data['output']= $crud->render();
    $this->render('admin/crud_view');
    }
    public function priority2()
  {
     
        $this->data['page_title'] = 'Relevant Questions with precedence';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('precedence2');
        $crud->set_subject('precedence2_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
     $crud->unset_columns('questionnaire_id');
      $crud->display_as('pj1','Column 1 precedence');
        $crud->display_as('pj2','Column 2 precedence');
        $crud->display_as('pj3','Column 3 precedence');
        $crud->display_as('pj4','Column 4 precedence');
        $crud->display_as('pj5','Column 5 precedence');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

   			$this->data['output']= $crud->render();
    		$this->render('admin/crud_view');
    }
    public function relevant()
  {
     
       $this->data['page_title'] = 'Final Questions';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('relevant');
        $crud->set_subject('relevant_table');
        $crud->callback_column('question_name', array($this,'full_text3'));
        
     //$crud->unset_columns('question_id');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

        $this->data['output']= $crud->render();
    	$this->render('admin/crud_view');
   
    }

public function full_text3($value,$row)
    {

      return $value = wordwrap($row->question_name, 300, "<br>", true);

    }
}







