<?php
class Site3 extends CI_Controller
{
	function index(){		

		$this->load->view('crud_simple');


		$this->load->model('data2_model');
		$this->model->add_record($data);
		$this->index();
		}

		function create(){

			$data=array(

				'stu_id' => $this->input->post('stud_id'),
				'stu_name' => $this->input->post('stud_name') );
		}

		
}
?>