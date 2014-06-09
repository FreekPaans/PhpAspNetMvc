<?php

namespace PhpAspNetMvc\Mvc;
use PhpAspNetMvc\Http\IHttpHandler;
use PhpAspNetMvc\Http\HttpContext;

class RequestContext {
	private $_context;
	private $_routeData;

	public function __construct(HttpContext $context, RouteDate $routeData) {
		$this->_context = $context;
		$this->_routeData = $routeData;
	}
}