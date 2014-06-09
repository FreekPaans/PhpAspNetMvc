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

RouteTable::GetRoutes()->IgnoreRoute(new String("{resource}.axd/{*pathInfo}"));
RouteTable::GetRoutes()->MapRoute(new String("Default"), new String("{controller}/{action}/{id}"), array('controller'=>new String("Home"),'action' => new String("Index")));

$request = HttpRequest::FromServerSuperGlobal();

$response = HttpResponse::EmptyResponse();

$context = new HttpContext($request,$response);

$handler = UrlRoutingModule::ResolveHandler($context);
$handler->ProcessRequest($context);

// $router = new Router();

// $router->RegisterRoute( new StaticContentRoute(new StaticMatcher(new String("/test.html")), new String("wasah")));
// $router->RegisterRoute( new ControllerActionResolverRoute(new SegmentMatcher(new String("{controller}/{action}"), array('controller'=>new String('home'), 'action'=>new String('index'))), new String('MyApp\Controllers')));



// $route = $router->ResolveRoute($request);



// $route->Execute($request, $response);