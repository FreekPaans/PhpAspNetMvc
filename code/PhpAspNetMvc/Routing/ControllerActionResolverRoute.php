<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

class ControllerActionResolverRoute implements Route {
	private $_matcher;
	
	public function __construct(Matchers\Matcher $matcher) {
		$this->_matcher = $matcher;
	}

	public function Execute(HttpRequest $request, HttpResponse $response) {
		$response->Write(new String('test'));
	}

	public function CanHandle(HttpRequest $request) {
		return $this->_matcher->Matches($request);
	}
}