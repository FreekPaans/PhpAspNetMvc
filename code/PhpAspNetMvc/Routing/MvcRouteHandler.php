<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class MvcRouteHandler implements IRouteHandler {
	public function GetHttpHandler(RequestContext $context) {
		return new MvcHandler($context);
	}
}