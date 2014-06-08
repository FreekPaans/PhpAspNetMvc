<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Types\String;


class Router {
	public static function ResolveRoute(HttpRequest $request) {
		return new StaticContentRoute(new String('wassah'));
	}
}