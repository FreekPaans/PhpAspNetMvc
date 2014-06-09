<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\Types\String;

class HttpContext {
	private $_request;
	private $_response;
	public function __construct(HttpRequest $request, HttpResponse $response) {
		$this->_request = $request;
		$this->_response = $response;
	}

	public function GetRequest() {
		return $this->_request;
	}

	public function GetResponse() {
		return $this->_response;
	}
}