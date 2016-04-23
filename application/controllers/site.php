<?php
class Site extends CI_Controller {

	function index(){
	//	echo 'hello world';
		$data['myValue'] = 'Some String';
		$data['anothervalue'] = 'Another String';

		$this->load->model('site_model');

		$data['records'] = $this->site_model->getAll();

		$this->load->view('home' , $data);
		//$this->load->view('home' , $data);

		
	}
	function hello(){
		echo 'this is narration';
	}

	function about(){


		$this->load->view('about');
	}
}
?>