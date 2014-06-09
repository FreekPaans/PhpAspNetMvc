<?php


namespace PhpAspNetMvc\Routing\Matchers\Segments;

use PhpAspNetMvc\Types\String;


class ParamMatch implements SegmentMatch {
	public function __construct($key, String $value) {
		$this->_key = $key;
		$this->_value = $value;
	}

	public function IsMatch() {
		return true;
	}

	public function HasParamValue() {
		return true;
	}

	public function GetParamKey() {
		return $this->_key;
	}

	public function GetParamValue() {
		return $this->_value;
	}

	public function AddRouteValues(array &$routeValues) {
		$routeValues[$this->_key] = $this->_value;
	}
}