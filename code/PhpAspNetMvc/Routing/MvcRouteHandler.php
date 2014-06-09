<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

use PhpAspNetMvc\Mvc\MvcHandler;

class MvcRouteHandler implements IRouteHandler {
	private $_controllerNamespace;

	public function __construct(String $controllerNamespace) {
		$this->_controllerNamespace=  $controllerNamespace;
	}

	public function GetHttpHandler(RequestContext $context) {
		return new MvcHandler($context, $this->_controllerNamespace);
	}
}