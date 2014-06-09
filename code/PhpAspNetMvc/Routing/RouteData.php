<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;

class RouteData {
	private $_routeHandler;
	private $_routeValues;
	public function __construct(RouteBase $route, IRouteHandler $routeHandler, RouteValueDictionary $values) {
		$this->_routeHandler = $routeHandler;
		$this->_routeValues = $values;
	}

	public function GetRequiredString($key) {
		if(!$this->_routeValues->ContainsKey($key)) {
			throw new \Exception(String::Format(new String("{0} is a required route value"), $key));
		}

		$value = $this->_routeValues->GetItem($key);

		if(!($value instanceof String)) {
			throw new \Exception(String::Format(new String("The value for key {0} must be a string, but is {1}"), $key, $value));
		}

		return $value;
	}

	public function GetRouteHandler() {
		return $this->_routeHandler;
	}
}