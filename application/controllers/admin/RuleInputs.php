<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RuleInputs extends Admin_Controller
{
	protected $single_threshold;
	protected $inputnamesofparameters = array();
	protected $multithreshold = array();   //value inputs in double
	protected $description_of_parameters = array();

}

public function getSingle_threshold(){
		return $this->single_threshold;
	}

	public function setSingle_threshold($single_threshold){
		$this->single_threshold = $single_threshold;
	}

	public function getInputnamesofparameters(){
		return $this->inputnamesofparameters;
	}

	public function setInputnamesofparameters($inputnamesofparameters){
		$this->inputnamesofparameters = $inputnamesofparameters;
	}

	public function getMultithreshold(){
		return $this->multithreshold;
	}

	public function setMultithreshold($multithreshold){
		$this->multithreshold = $multithreshold;
	}

	public function getDescription_of_parameters(){
		return $this->description_of_parameters;
	}

	public function setDescription_of_parameters($description_of_parameters){
		$this->description_of_parameters = $description_of_parameters;
	}