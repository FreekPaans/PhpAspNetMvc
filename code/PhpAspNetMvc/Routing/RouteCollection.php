<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class RouteCollection implements \IteratorAggregate  {
	public function __construct() {
		$this->_routes = ImmutableList::CreateNew();
	}

	public function IgnoreRoute(String $url) {
		throw new \Exception("not implemented yet");
	}

	public function MapRoute(String $controllerNamespace, String $name, String $url, array $defaults) {
		$route = new Route($url, new MvcRouteHandler($controllerNamespace), RouteValueDictionary::FromArray($defaults));
		$this->_routes = $this->_routes->Add($route);
	}

	public function getIterator() {
		return $this->_routes->getIterator();
	}
}