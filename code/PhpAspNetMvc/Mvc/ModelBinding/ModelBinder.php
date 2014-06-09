<?php

namespace PhpAspNetMvc\Mvc\ModelBinding;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;

class ModelBinder {
	public static function Bind(HttpRequest $request, \ReflectionMethod $method) {
		return array(
			new Integer(1),
			new String('wassa')
		);
	}
}