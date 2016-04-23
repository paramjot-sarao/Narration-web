<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpages extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->data['page_title'] = 'front pages';
 
    
    $this->render('admin/dashboard_view');
  }

   public function questions()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Questions';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
		$crud->set_table('questions');
		$crud->set_subject('Questions');
		$crud->fields('question_name','metadescription','created_at','updated_at','scale_id', 'group','questionnaire_id');

		$crud->set_relation('scale_id','scales','name');

		$crud->set_relation('questionnaire_id','questionnaireone','questionnaire_name');//for foreign key

    $crud->callback_column('question_name', array($this,'full_text'));
    $crud->callback_column('metadescription', array($this,'full_text2'));

		 $crud->field_type('created_at', 'hidden');
		 $crud->field_type('updated_at', 'hidden');
		$crud->columns('question_id','question_name','metadescription','scale_id', 'group');
    $crud->display_as('scale_id','Scales');
    $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();


		  $data['output'] = $crud->render();

        $data['view'] = 'front/questions';        

        $this->load->view('front/index', $data);
        
    }

    public function full_text($value,$row)
    {

      return $value = wordwrap($row->question_name, 150, "<br>", true);

    }
     public function full_text2($value,$row)
    {

      return $value = wordwrap($row->metadescription, 100, "<br>", true);

    }

    public function scales()
  {
         $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Scales';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
    $crud->set_table('scales');
    $crud->set_subject('scales');
    
   $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $data['output'] = $crud->render();
     $data['view'] = 'front/scales';    

        $this->load->view('front/index', $data);
        

  }

  public function users()
  {
        $this->load->library('Ion_auth');
       $data['users'] = $this->ion_auth->users(2)->result();

       foreach ($data['users'] as $user) {
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

        $data['view'] = 'front/users'; 

       $this->load->view('front/index', $data);

  }

public function response()
  {
     $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Responses';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('qfdone');
        $crud->set_subject('qfdone_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
        $crud->callback_column('value1',array($this,'Scaleratingvalues'));
        $crud->callback_column('value2',array($this,'Scaleratingvalues'));
        $crud->callback_column('value3',array($this,'Scaleratingvalues'));
        $crud->callback_column('value4',array($this,'Scaleratingvalues'));
        $crud->callback_column('value5',array($this,'Scaleratingvalues'));

        $crud->unset_columns('questionnaire_id');
        $crud->display_as('value1','Scale rating value 1');
        $crud->display_as('value2','Scale rating value 2');
        $crud->display_as('value3','Scale rating value 3');
        $crud->display_as('value4','Scale rating value 4');
        $crud->display_as('value5','Scale rating value 5');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $data['output'] = $crud->render();
     $data['view'] = 'front/responses';    
        $this->load->view('front/index', $data);
        }

      public function Scaleratingvalues($value)
      {
        return $value.' '.' users';
      }

   public function priority()
  {
     $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Priority';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('precedence');
        $crud->set_subject('precedence_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
        $crud->unset_columns('questionnaire_id');
        $crud->display_as('pj1','Column 1 precedence(Pipj1)');
        $crud->display_as('pj2','Column 2 precedence(Pipj2)');
        $crud->display_as('pj3','Column 3 precedence(Pipj3)');
        $crud->display_as('pj4','Column 4 precedence(Pipj4)');
        $crud->display_as('pj5','Column 5 precedence(Pipj5)');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $data['output'] = $crud->render();
     $data['view'] = 'front/priority';    
        $this->load->view('front/index', $data);
        }

public function priority2()
  {
     $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Priority2';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('precedence2');
        $crud->set_subject('precedence2_table');
        $crud->set_relation('question_id','questions','{question_id}-{question_name}');
        $crud->unset_columns('questionnaire_id');
      $crud->display_as('pj1','Column 1 precedence(Pipj1)');
        $crud->display_as('pj2','Column 2 precedence(Pipj2)');
        $crud->display_as('pj3','Column 3 precedence(Pipj3)');
        $crud->display_as('pj4','Column 4 precedence(Pipj4)');
        $crud->display_as('pj5','Column 5 precedence(Pipj5)');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $data['output'] = $crud->render();
     $data['view'] = 'front/priorities';    
        $this->load->view('front/index', $data);
        }

    public function relevant()
  {
     $data['metad']="";
        $data['metak']="";
        $data['title'] = 'Final';
        
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

         $crud->set_table('relevant');
        $crud->set_subject('relevant_table');

        $crud->callback_column('question_name', array($this,'full_text3'));
        $crud->callback_column('question_id', array($this,'full_text4'));
        
     //$crud->unset_columns('question_id');
         $crud->unset_add()
         ->unset_edit()
         ->unset_delete()
         ->unset_read();

    $data['output'] = $crud->render();
     $data['view'] = 'front/relevant';    
        $this->load->view('front/index', $data);
        }

public function full_text3($value,$row)
    {

      return $value = wordwrap($row->question_name, 300, "<br>", true);

    }
    public function full_text4($value,$row)
    {

      return $value = wordwrap($row->question_id, 100, "<br>", true);

    }
  


   }
