<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\IO\TextWriter;

class HttpWriter extends TextWriter {
	public function __construct(HttpResponse $response) {
		$this->_response=  $response;
	}

	public function Write($data) {
		$this->_response->Write($data);
	}
}