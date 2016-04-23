<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class reportstructure_model extends MY_Model
{

	public function __construct()
	{
       
        //$this->load->model('Googleanalyticsdata_model', 'gmodel');
        $this->load->library('NarrationEngine');
		parent::__construct();

	}

	public function title($startdate1)
	{
		$html = '<table class = "table ">
    <thead>
    <style>
    h3 {color:green;}
    h4 {color:green;}
    p {color:red;}
    </style>
    </thead>
    <tbody>
    <tr>
            <td  align="center"><h3>';
            
            $startdate2 = date('M.d',strtotime("$startdate1 -1 week"));
            $startdate3 = date('M.d,Y',strtotime("$startdate1"));
           
      $html += 'Week of '.$startdate2.' - '.$startdate3;

      $html += '</h3></td>   
		    </tr>           
		       
		    </tbody>
		</table>';
		return $html;
	}
}