<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Routing\RequestContext;

class ControllerContext {
	public function __construct(RequestContext $context, ControllerBase $controller) {
		$this->_context = $context;
	}

	public function GetRouteData() {
		return $this->_context->GetRouteData();
	}

	public function GetHttpContext() {
		return $this->_context->GetHttpContext();
	}
}