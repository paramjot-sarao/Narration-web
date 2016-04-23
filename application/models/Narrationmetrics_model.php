 <?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Narrationmetrics_model extends MY_Model
{

	public function __construct()
	{
        
		parent::__construct();
	}
	
	public function narrationmetrics()  
	{
		

		$output = $this->sessions();
		return $output;
	}
	public function sessions()
    {
		$new = $this->db->select('name ,formula, description')
							->from('metrics')
							->get()
							->result_array();
		
		return $new;
		
		
		/*$pcc = '[(unique pageviews)*(number of entrances / total number of sessions)] / (pageviews)';
		$rvr = '(number of repeatusers / total number of users) * 100;';
		$dap = '(number of goals completed / total number of sessions) * 100';
		$bouncerate = '(number of bounces / total number of sessions ) * 100';
		$unique = 'pageviews - reloads';
		$exitrate =('number of exits / pageviews) * 100';
		$asd = 'session duartion / total number of sessions';
		$new = '(number of new users / total number of users) * 100';
		$spu = 'total number of sessions / total number of users';
		$ete = 'number of entrances / number of exits';
		$ved = 'pageviews / total number of users';
		$path = '[(number of exits - number of bounces) / (pageviews - number of entrances)] * 100';
		$traffic = 'number of targeted landing page users / total number of users';
		$page = 'pageviews / toal number of sessions';

		$final = array('$pcc','$rvr','$dap','$bouncerate','$unique','$exitrate','$asd','$new')*/


    }
		    
	    

}