 <?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Autogeneratetree_model extends MY_Model
{

	public function __construct()
	{
        $this->table = 'autogeneratetree';
        $this->primary_key = 'id';
        $this->timestamps = TRUE; 

		parent::__construct();
	}

	
}