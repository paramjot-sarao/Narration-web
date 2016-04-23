<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empiricalrules extends Admin_Controller
{

	public function mean($arr)
	{
		return average($arr);
	}

	public function sd_square($x, $mean)
	{ 
		return pow($x - $mean,2); 
	}

	public function StandardDeviation($values)
	{
		// square root of sum of squares devided by N-1
		return sqrt( array_sum( array_map(
				"sd_square", $values, 
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

	public getresult($array)
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

		if($highest == $section3_count)
		{
			return true;
		}
		else {
			return false;
		}

	}

	
}
