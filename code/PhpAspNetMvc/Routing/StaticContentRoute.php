<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

class StaticContentRoute implements Route {
	private $_content;
	
	public function __construct(String $content) {
		$this->_content = $content;
	}

	public function Execute(HttpRequest $request, HttpResponse $response) {
		echo($this->_content);
	}
}