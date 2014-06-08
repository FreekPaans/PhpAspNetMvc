<?php

namespace PhpAspNetMvc\Http;

class HttpResponse{
	public static function EmptyResponse() {
		return new HttpResponse();
	}
}