<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RuleCheckTheChange extends Admin_Controller
{

	function calculatedatebounds($days)
	{	
		$last = $this->uri->total_segments();
    	$days = $this->uri->segment($last);
    	echo $days.'<br>';

		$thisweek_startdate = strtotime("-$days days");
		$thisweek_enddate = strtotime("now");

		$lastweekdays = $days * 2;
		$lastweek_startdate = strtotime("-$lastweekdays days");
		$lastweek_enddate = strtotime("-$days days");
		
		return array(
			'thisweek_startdate' => $thisweek_startdate,
			'thisweek_enddate' 	=> $thisweek_enddate,
			'lastweek_startdate' => $lastweek_startdate,
			'lastweek_enddate' => $lastweek_enddate
			);

	}
	public function CheckTheChange($inputs)
	{
		$datebounds = $this->calculatedatebounds($inputs->days);
		
		$this->load->model('Googleanalyticsdata_model', 'googleanalytics');
		
		$lastweek_data = $this->googleanalytics->where('created_at BETWEEN $datebounds->lastweek_startdate AND $datebounds->lastweek_enddate')->get();

		$thisweek_data = $this->googleanalytics->where('created_at BETWEEN $datebounds->thisweek_startdate AND $datebounds->thisweek_enddate')->get();

		$rateofchange = ( 
							( array_sum($thisweek_data) - array_sum($lastweek_data) )  /
							( array_sum($thisweek_data) + array_sum($lastweek_data) )
						) * 100 ;

		if($rateofchange > 0) ? $interpretation = 'positive' : $interpretation = 'negative';

		//call empiricalrules on $thisweek_data

		$ouputs = array(
			'rateofchange' => $rateofchange,
			'interpretation' => $interpretation
			);

		return array(
			'ouputs' => $ouputs,
			'inputs' => $inputs
			);
	}

	/*public function testChange()
	{
		$thisweek_data = array(1,3,4);
		$lastweek_data = array(9,7,5);

		$rateofchange = ( 
							( array_sum($thisweek_data) - array_sum($lastweek_data) )  /
							( array_sum($thisweek_data) + array_sum($lastweek_data) )
						) * 100 ;
		echo $rateofchange;
	}*/
}