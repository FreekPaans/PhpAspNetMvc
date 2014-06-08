<?php


namespace PhpAspNetMvc\Routing\Matchers\Segments;

use PhpAspNetMvc\Types\Boolean;

class DirectMatch implements SegmentMatch {
	private $_isMatch;

	public function __construct(Boolean $isMatch) {
		$_isMatch = $isMatch->ToBoolean();
	}
	public function HasParamValue() {
		return Boolean::false();
	}
	public function GetParamKey() {
		throw new \Exception(new String("Not a param match"))
	}
	public function GetParamValue() {
		throw new \Exception(new String("Not a param match"))
	}

	public function IsMatch() {
		return $this->_isMatch;
	}
}
