<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\Net\Uri;
use PhpAspNetMvc\Types\String;

class HttpRequest {
	private $_uri;

	private function __construct(Uri $uri) {
		$this->_uri = $uri;
	}

	public static function FromServerSuperGlobal() {
		return new HttpRequest(self::ExtractUri($_SERVER));
	}

	private static function ExtractUri($serverContainer) {
		return new Uri(
			new String("http"),
			new String($serverContainer['HTTP_HOST']),
			new String($serverContainer['REQUEST_URI'])
		);
	}

	public function GetUri(){
		return $this->_uri;
	}
}