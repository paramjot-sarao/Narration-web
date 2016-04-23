<?php
class Data2_model extends CI_Model{
	function create_record(){
		$q = $this->db->get('stu_ifo');
		return $q->result();
	}

	function add_record($data){
		$this->db->insert('stu_ifo' , $data);
		return;
	}
	function update_record($data){
		$this->db->where('stu_id' , 2);
		$this->db->update('stu_ifo' , $data);
	}

	function delete_row(){
		$this->db->where('stu_id' , $this->uri->segment(3));
		$this->db->delete('stu_ifo');
		
	}
}