<?php

namespace PhpAspNetMvc\Routing;

class RouteTable {
	private static $_routes;

	public static function GetRoutes() {
		self::AssertRoutes();
		return self::$_routes;
	}

	private static function AssertRoutes() {
		if(self::$_routes!==null) {
			return;
		}

		self::$_routes = new RouteCollection();
	}
}