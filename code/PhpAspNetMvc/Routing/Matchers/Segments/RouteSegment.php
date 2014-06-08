<?php

namespace PhpAspNetMvc\Routing\Matchers\Segments;

use PhpAspNetMvc\Types\String;

class RouteSegment {
	private $_routeSegment;

	public function __construct(String $routeSegment) {
		$this->_routeSegment = $routeSegment;
	}

	public function Match(String $pathValue) {
		if(!$this->HasParam()) {
			return new DirectMatch($this->_routeSegment === $pathValue);
		}

		return new ParamMatch($this->GetParamName(), $pathValue);
	}

	private function GetParamName() {
		$match = preg_match("/^\{(\w{1,})\}$/",(string)$this->_routeSegment, $matches);

		if($match===false) {
			return null;
		}

		return $matches[1];
	}

	public function HasParam() {
		return $this->GetParamName()!==null;
	}
}