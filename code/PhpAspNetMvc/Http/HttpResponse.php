<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\Types\String;

class HttpResponse{
	private function __construct() {
	}

	public static function EmptyResponse() {
		return new HttpResponse();
	}

	public function Write($content) {
		echo $content;
	}

	public function SetContentType(String $contentType) {
		header(String::Format(new String('Content-Type: {0}'), $contentType));
	}

	public function GetTextWriter() {
		return new HttpWriter($this);
	}
}