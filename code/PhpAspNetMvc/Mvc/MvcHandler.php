<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Http\IHttpHandler;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Routing\RouteTable;

class MvcHandler implements IHttpHandler{
	public function __construct(RequestContext $context) {

	}

	public function ProcessRequest(HttpContext $context) {
		$routeDate = RouteTable::GetRoutes()->GetRouteData($context);

		$routeDate->GetRouteHandler()->GetHttpHandler()->ProcessRequest($context);
	}
}