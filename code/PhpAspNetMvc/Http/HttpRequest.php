<?php

namespace PhpAspNetMvc\Http;

class HttpRequest {
	public static function FromServerSuperGlobal() {
		return new HttpRequest();
	}
}