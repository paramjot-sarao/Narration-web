<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentpage extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth'); 
  }

  public function childa()
  {
    $this->data['page_title'] = 'Parent';
   
    $this->render('admin/parentpage_view','admin_master');
  }
  public function childb()
  {
    $this->data['page_title'] = 'Parent';
   
    $this->render('admin/parentpage_view','admin_master');
  }

}