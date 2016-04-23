<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RuleAutoNarrate extends Admin_Controller
{

	public function fetchnarration($checkchange)
	{	


		switch ($checkchange->change) {
			case 'positive':
					//Select * from table where positive narration is given for $checkchange->parametername
					$where = array(
						'nodename' => $checkchange->nodename,
						'operator' => 'positive'
						);
					$this->load->model('Autogeneratetree_model', 'autogenerate');
					$result = $this->autogenerate->where($where)->get();
				break;
			case 'negative':
					$where = array(
						'nodename' => $checkchange->nodename,
						'operator' => 'negative'
						);
					$this->load->model('Autogeneratetree_model', 'autogenerate');
					$result = $this->autogenerate->where($where)->get();
				break;
			case 'outlier':
					$where = array(
						'nodename' => $checkchange->nodename,
						'operator' => 'outlier'
						);
					$this->load->model('Autogeneratetree_model', 'autogenerate');
					$result = $this->autogenerate->where($where)->get();
				break;
			
			default:
				# code...
				break;
		}
	}
}