<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Http\HttpRequest;

class Route implements RouteBase {
	private $_segments;
	private $_defaults;
	private $_hanlder;

	public function __construct(String $url, IRouteHandler $handler, RouteValueDictionary $defaults){
		$this->_segments = $url->Split(new String('/'),true)->Map(function(String $seg) { return new RouteSegment($seg);});
		$this->_defaults = $defaults;
		$this->_handler = $handler;
	}

	public function GetRouteData(HttpContext $context) {
		if(!$this->TryMatch($context->GetRequest(), $routeValues)) {
			return null;
		}

		return new RouteData($this,$this->_handler, $routeValues);
	}


	private function TryMatch(HttpRequest $request, &$routeValues){
		$requestPathSegments = $request->GetUri()->GetPath()->Split(new String('/'), true);
		
		$i = new Integer(0);

		$tmpRouteValues = RouteValueDictionary::CreateNew();

		foreach($this->_segments as $segment) {
			if(!$segment->Match($requestPathSegments, $i, $this->_defaults, $tmpRouteValues, $newTmpRouteValues)) {
				return false;
			}

			$tmpRouteValues = $newTmpRouteValues;

			$i = $i->Increment();
		}

		$routeValues = $tmpRouteValues;

		return true;
	}
}