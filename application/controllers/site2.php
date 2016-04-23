<?php
class Site2 extends CI_Controller {
function index() {
		$this->load->model('data_model');
		$data['record'] = $this->data_model->getAll();


		$this->load->view('home2', $data);
	}
}
?>