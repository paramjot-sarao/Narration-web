<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NarrationEngine {

	//public $phi = (1 + Math.sqrt(5)) / 2;
	//public $resphi = 2 - $phi;

  public function calculatedatebounds($days)
	{	
		/*$last = $this->uri->total_segments();
    	$days = $this->uri->segment($last);
    	echo $days.'<br>';*/

		$thisweek_startdate = date('Y-m-d',strtotime("-$days days"));
		$thisweek_enddate = date('Y-m-d',strtotime("now"));

		$lastweekdays = $days * 2;
		$lastweek_startdate = date('Y-m-d',strtotime("-$lastweekdays days"));
		$lastweek_enddate = date('Y-m-d',strtotime("-$days days"));
		
		return array(
			'thisweek_startdate' => $thisweek_startdate,
			'thisweek_enddate' 	=> $thisweek_enddate,
			'lastweek_startdate' => $lastweek_startdate,
			'lastweek_enddate' => $lastweek_enddate
			);
	}

	public function newcalculatedatebounds($startdate,$enddate)
	{	
		/*$last = $this->uri->total_segments();
    	$days = $this->uri->segment($last);
    	echo $days.'<br>';*/

    	$thisweek_startdate = $startdate;
		$thisweek_enddate = $enddate;

		$lastweek_startdate = date('Y-m-d',strtotime("$startdate -1 week"));
		$lastweek_enddate = $startdate;
		
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

		if($rateofchange > 0) {
			$interpretation = 'positive';
		} else {
			$interpretation = 'negative';
		}

		//call empiricalrules on $thisweek_data

		$empiricalrule_result = $this->getresult($thisweek_data);

		$ouputs = array(
			'rateofchange' => $rateofchange,
			'interpretation' => $interpretation,
			'outlier'		=> $empiricalrule_result
			);

		return array(
			'ouputs' => $ouputs,
			'inputs' => $inputs
			);
	}


	public function Rateofchange($thisweek_data,$lastweek_data)
	{
		
		$result = array();
		$indexes = array('sessions','users','desktop_users',
            'mobile_users','tablet_users','pageviews','unique_pageviews',
            'sessions_with_events','exit_rate','average_session_duration','bounce_rate',
            'pathloss','visitor_Engagement_Degree','primary_content_consumption',
            'new_visitor_percentage','sessions_per_user',
            'entry_to_exit_ratio','page_depth','landing_page_users',
            'traffic_concentration',
            'conversion_rate','repeat_visitor_ratio');
			
		foreach ($indexes as $index) 
            {
                
            $val1 = $thisweek_data[$index] - $lastweek_data[$index]; 
            $val2 = $thisweek_data[$index] + $lastweek_data[$index];
            $val3 = ($val1 / $val2) * 100;
           	$val4 = round($val3,2);
            if($val4 == -0.00)
            {
            	$val4 = 0.00;
            	$result[$index] = $val4;
            }
            else
            {
            $result[$index] = $val4;
        	}
            //            array_push($result[$index],$val3[$index]);
           
        }       
      			
		return $result;
	}

	public function fetchnarration($checkchange)
	{	

		switch ($checkchange->interpretation) {
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
			case 'equal':
					$where = array(
						'nodename' => $checkchange->nodename,
						'operator' => 'equal'
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


	// Emprical Rules / Mathermatical Calulations for Narrartion

	public function mean($arr)
	{
		
		
		return array_sum($arr) / count($arr);
	}

	public function sd_square($x, $mean)
	{ 
		return pow($x - $mean,2); 
	}

	public function StandardDeviation($values)
	{
		// square root of sum of squares devided by N-1
		return sqrt( array_sum( array_map(
				array($this, "sd_square"), $values, 
				array_fill(0,count($values),
					(array_sum($values) / count($values)) 
					) 
				) )
		/ (count($values)-1) );
	}

	public function Section1()
	{
		$mean = $this->mean($valuesarray);
		$StandardDeviation = $this->StandardDeviation($valuesarray);

		$a = $mean - $StandardDeviation;
		$b = $mean + $StandardDeviation;

		return array(
			'a' => $a,
			'b' => $b
			);
	}

	public function Section2()
	{
		$mean = $this->mean($valuesarray);
		$StandardDeviation = $this->StandardDeviation($valuesarray);

		$section1_bounds = $this->Section1($valuesarray);

		$c = $mean - (2 * $StandardDeviation);
		$d = $mean + (2 * $StandardDeviation);

		return array(
			'a' => $section1_bounds['a'],
			'b' => $section1_bounds['b'],
			'c' => $c,
			'd' => $d
			);
	}

	public function Section3()
	{
		$mean = $this->mean($valuesarray);
		$StandardDeviation = $this->StandardDeviation($valuesarray);

		$e = $mean - (3 * $StandardDeviation);
		$f = $mean + (3 * $StandardDeviation);

		$section2_bounds = $this->Section2($valuesarray);

		return array(
			'c' => $section2_bounds['c'],
			'd' => $section2_bounds['d'],
			'e' => $e,
			'f' => $f
			);
	}

	public function getresult($array)
	{
		$section1_bounds = $this->Section1($array);
		$section2_bounds = $this->Section2($array);
		$section3_bounds = $this->Section3($array);

		$section1_count = 0;
		$section2_count = 0;
		$section3_count = 0;

		foreach ($array as $value) {
			if (($value > $section1_bounds['a'] && $value < $section1_bounds['b']))
			{
				$section1_count++;
			}
			if (($value > $section2_bounds['c'] && $value < $section2_bounds['a']) || ($value > $section2_bounds['b'] && $value < $section2_bounds['d']))
			{
				$section2_count++;
			}
			if (($value > $section3_bounds['e'] && $value < $section3_bounds['c']) || ($value > $section3_bounds['d'] && $value < $section2_bounds['f']))
			{
				$section3_count++;
			}
		} 

		$highest = max($section1_count, $section2_count, $section3_count);

		// Returns true if the highest value lies in section 3
		if($highest == $section3_count)
		{
			return true;
		}
		else {
			return false;
		}

	}

	public function ObjectiveFunction($x)
	{
		$y = $x+2;
	  return $y;
	}

	/*public function goldenSectionSearch($a,$b, $c,$tau) {
	    double x;
	    if ($c - $b > $b - $a) {
	      $x = $b + $this->resphi * ($c - $b);
	    }
	    else {
	      $x = $b - $this->resphi * (b - a);
	    }

	    if (Math.abs($c - $a) < $tau * (Math.abs($b) + Math.abs($x))) 
	    {
	      return ($c + $a) / 2; 
	    }

     	assert(ObjectiveFunction($x) != ObjectiveFunction($b));

	    if (ObjectiveFunction($x) < ObjectiveFunction($b)) {
	      if ($c - $b > $b - $a) {
	      	return goldenSectionSearch($b, $x, $c, $tau);
	      }
	      else {
	      	return;urn goldenSectionSearch($a, $x, $b, $tau);
	      }
	    }
	    else {
	      if ($c - $b > $b - $a){
	      	return goldenSectionSearch($a, $b, $x, $tau);
	      } 
	      else {
	      	return goldenSectionSearch($x, $b, $c, $tau);
	      }
	    }
  	}*/

	
}