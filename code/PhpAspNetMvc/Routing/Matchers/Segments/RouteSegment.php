<?php

namespace PhpAspNetMvc\Routing\Matchers\Segments;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\Integer;

class RouteSegment {
	private $_routeSegment;

	public function __construct(String $routeSegment) {
		$this->_routeSegment = $routeSegment;
	}

	public function Match(ImmutableList $segments, Integer $segmentPosition, array $defaults) {
		$hasValue = $segments->InRange($segmentPosition);

		if(!$this->HasParam()) {
			if(!$hasValue) {
				return new DirectMatch(false);
			}
			return new DirectMatch($this->_routeSegment->Equals($segments->ItemAt($segmentPosition)));
		}

		$paramName = $this->GetParamName();

		$pathValue = null;

		if($hasValue) {
			return new ParamMatch($paramName, $segments->ItemAt($segmentPosition));
		}

		if(array_key_exists($paramName, $defaults)) {
			return new ParamMatch($paramName, $defaults[$paramName]);
		}

		return new DirectMatch(false);
	}

	private function GetParamName() {
		$match = preg_match("/^\{(\w{1,})\}$/",(string)$this->_routeSegment, $matches);

		if($match===false) {
			return null;
		}

		return $matches[1];
	}

	private function HasParam() {
		return $this->GetParamName()!==null;
	}
}