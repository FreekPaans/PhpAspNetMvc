<?php

namespace PhpAspNetMvc\Routing;
use PhpAspNetMvc\Http\IHttpHandler;
use PhpAspNetMvc\Http\HttpContext;

class RequestContext {
	private $_context;
	private $_routeData;

	public function __construct(HttpContext $context, RouteData $routeData) {
		$this->_context = $context;
		$this->_routeData = $routeData;
	}

	public function GetRouteData() {
		return $this->_routeData;
	}

	public function GetHttpContext() {
		return $this->_context;
	}
}