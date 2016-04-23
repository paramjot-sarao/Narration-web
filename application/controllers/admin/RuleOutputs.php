<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RuleOutputs extends Admin_Controller
{
	protected $single_threshold;
	protected $outputnamesofparameters = array();
	protected $outputvaluesofparameters = array();
	protected $multithreshold = array();   //value inputs in double
	protected $description_of_parameters = array();

	protected $changepercentage;
	
}

public function getSingle_threshold(){
		return $this->single_threshold;
	}

	public function setSingle_threshold($single_threshold){
		$this->single_threshold = $single_threshold;
	}

	public function getOutputnamesofparameters(){
		return $this->outputnamesofparameters;
	}

	public function setOutputnamesofparameters($outputnamesofparameters){
		$this->outputnamesofparameters = $outputnamesofparameters;
	}

	public function getOutputvaluesofparameters(){
		return $this->outputvaluesofparameters;
	}

	public function setOutputvaluesofparameters($outputvaluesofparameters){
		$this->outputvaluesofparameters = $outputvaluesofparameters;
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

	public function getChangepercentage(){
		return $this->changepercentage;
	}

	public function setChangepercentage($changepercentage){
		$this->changepercentage = $changepercentage;
	}