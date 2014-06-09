<?php

namespace PhpAspNetMvc\Mvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;

interface Route {
	public function Execute(HttpRequest $request, HttpResponse $response);
	public function CanHandle(HttpRequest $request);
}