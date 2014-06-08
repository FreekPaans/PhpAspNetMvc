<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\Types\String;

class HttpResponse{
	private function __construct() {
	}

	public static function EmptyResponse() {
		return new HttpResponse();
	}

	public function Write(String $content) {
		echo $content;
	}
}