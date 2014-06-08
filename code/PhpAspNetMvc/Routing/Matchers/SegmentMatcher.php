<?php

namespace PhpAspNetMvc\Routing\Matchers;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Routing\Matchers\Segments\RouteSegment;

class SegmentMatcher implements Matcher{
	public function __construct(String $segments, array $defaults) {
		$this->_segments = $segments->Split(new String('/'))->Map(function($it) { return new RouteSegment($it);});
		$this->_defaults = $defaults;
	}

	private function TryMatch(HttpRequest $request, &$matches){
		$requestPathSegments = $request->GetUri()->GetPath()->Split(new String('/'), true);
		
		$i = new Integer(0);

		$params = array();

		foreach($this->_segments as $segment) {
			$segMatch = $segment->Match($requestPathSegments->ItemAt($i));	

			$i = $i->Increment();
			
			if(!$segMatch->IsMatch()) {
				return false;
			}

			if(!$segMatch->HasParamValue()) {
				continue;
			}

			$params[$segMatch->GetParamKey()] = $segMatch->GetParamValue();
		}

		$matches = $params;

		return true;
	}

	public function Matches(HttpRequest $request) {
		return $this->TryMatch($request,$match);
	}

	public function Match(HttpRequest $request) {
		$matched = $this->TryMatch($request, $params);
		if($matched!==true) {
			throw new \Exception("Couldn't match request");
		}


		return new Match($params);
	}
}