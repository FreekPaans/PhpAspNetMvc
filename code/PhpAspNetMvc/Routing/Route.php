<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;

interface Route {
	public function Execute(HttpRequest $request, HttpResponse $response);
}