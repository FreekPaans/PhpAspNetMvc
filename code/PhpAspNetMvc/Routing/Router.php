<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class Router {
	private $_routes;

	function __construct() {
		$this->_routes = ImmutableList::CreateNew();		
	}

	public function ResolveRoute(HttpRequest $request) {
		foreach($this->_routes as $route) {
			if(!$route->CanHandle($request)) {
				continue;
				
			}
			return $route;
		}

		throw new \Exception(string::Format(new String("No route found for {0}"), $request->GetUri()->GetPathAndQuery()));
	}

	public function RegisterRoute(Route $route) {
		$this->_routes = $this->_routes->Add($route);
	}
}