<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

interface  IRouteHandler {
	public function GetHttpHandler(RequestContext $context);
}