<?php

namespace PhpAspNetMvc\Mvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

class StaticContentRoute implements Route {
	private $_content;
	private $_matcher;
	
	public function __construct(Matchers\Matcher $matcher, String $content) {
		$this->_content = $content;
		$this->_matcher = $matcher;
	}

	public function Execute(HttpRequest $request, HttpResponse $response) {
		$response->Write($this->_content);
	}

	public function CanHandle(HttpRequest $request) {
		return $this->_matcher->Matches($request);
	}
}