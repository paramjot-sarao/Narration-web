<?php

class Data_model extends CI_Model{
/*	
function getAll(){

	$q = $this->db->query("SELECT * FROM stu_ifo");
	if($q->num_rows() > 0) {
 foreach($q->result() as $row) {

 	$data[] = $row;
 }
 	return $data;

	}
}*/


// this is the code for active records
function getall(){
	$this->db->select('stu_id,stu_name,stu_phne');
	$q = $this->db->get('stu_ifo');
	if($q->num_rows() > 0) {
 foreach($q->result() as $row) {

 	$data[] = $row;
 }
 	return $data;
 }


}

}