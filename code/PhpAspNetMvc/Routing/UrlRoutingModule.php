<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Mvc\RequestContext;
use PhpAspNetMvc\Types\String;

class UrlRoutingModule {
	public static function ResolveHandler(HttpContext $context) {
		$routes = RouteTable::GetRoutes();
		
		foreach($routes as $route) {
			$routeData = $route->GetRouteData($context);
			if($routeData!==null) {
				$requestContext = new RequestContext($context, $routeData);
				return $routeData->GetRouteHandler()->GetHttpHandler($requestContext);
			}

		}

		throw new \Exception(new String("Couldn't find route for request"));
	}	
}