 <?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ijorcsanalyticsdata2_model extends MY_Model
{

	public function __construct()
	{
        $this->table = 'newijorcs2';
        $this->primary_key = 'id';
	    $this->timestamps = TRUE; 
	    

		parent::__construct();
	}
		
	
    
}