<?php

include '../code/thirdparty/Autoload/SplClassLoader.php';

(new SplClassLoader('PhpAspNetMvc', '../code/'))->register();
(new SplClassLoader('MyApp', '../code/'))->register();


use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Mvc\Routing\Router;
use PhpAspNetMvc\Mvc\Routing\StaticContentRoute;
use PhpAspNetMvc\Mvc\Routing\ControllerActionResolverRoute;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Mvc\Routing\Matchers\StaticMatcher;
use PhpAspNetMvc\Mvc\Routing\Matchers\SegmentMatcher;
use PhpAspNetMvc\Mvc\MvcHandler;
use PhpAspNetMvc\Routing\RouteTable;
use PhpAspNetMvc\Routing\UrlRoutingModule;
use PhpAspNetMvc\Mvc\PhpViewEngine;
use PhpAspNetMvc\Mvc\ViewEngines;

RouteTable::GetRoutes()->MapRoute(
		new String('\MyApp\Controllers'),
		new String("Default"), 
		new String("{controller}/{action}/{id}"), 
		array(
				'controller'=>new String("Home"),
				'action' => new String("Index"),
				'id' => \PhpAspNetMvc\Mvc\UrlParameter::Optional()
		)
	);

$viewPath = dirname(__FILE__).'/../code/MyApp/Views';

ViewEngines::GetEngines()->Add(new PhpViewEngine(new String($viewPath)));

$request = HttpRequest::FromServerSuperGlobal();

$response = HttpResponse::EmptyResponse();

$context = new HttpContext($request,$response);

$handler = UrlRoutingModule::ResolveHandler($context);
$handler->ProcessRequest($context);