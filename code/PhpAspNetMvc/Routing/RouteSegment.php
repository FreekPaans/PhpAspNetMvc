<?php

namespace PhpAspNetMvc\Routing;

use  PhpAspNetMvc\Types\String;
use  PhpAspNetMvc\Types\ImmutableList;
use  PhpAspNetMvc\Types\Integer;

class RouteSegment {
	public function __construct(String $routeSegment) {
		$this->_routeSegment = $routeSegment;
	}

	public function Match(ImmutableList $segments, Integer $segmentPosition, RouteValueDictionary $defaults, RouteValueDictionary $routeValues, &$newRouteValues) {
		$hasValue = $segments->InRange($segmentPosition);

		$newRouteValues = $routeValues;

		if(!$this->HasParam()) {
			if(!$hasValue) {
				return false;
			}
			return $this->_routeSegment->Equals($segments->ItemAt($segmentPosition));
		}

		$paramName = $this->GetParamName();

		$pathValue = null;

		if($hasValue) {
			$newRouteValues = $newRouteValues->Add($paramName, $segments->ItemAt($segmentPosition));
			return true;
		}

		if($defaults->ContainsKey($paramName, $defaults)) {
			$newRouteValues = $newRouteValues->Add($paramName, $defaults->GetItem($paramName));
			return true;
		}

		return false;
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
