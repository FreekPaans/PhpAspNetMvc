<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Http\HttpRequest;

interface RouteBase  {
	public function GetRouteData(HttpContext $httpContext);
}