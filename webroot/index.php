<?php

include '../code/thirdparty/Autoload/SplClassLoader.php';

(new SplClassLoader('PhpAspNetMvc', '../code/'))->register();
(new SplClassLoader('MyApp', '../code/'))->register();


use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Mvc\Routing\Router;
use PhpAspNetMvc\Mvc\Routing\StaticContentRoute;
use PhpAspNetMvc\Mvc\Routing\ControllerActionResolverRoute;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Mvc\Routing\Matchers\StaticMatcher;
use PhpAspNetMvc\Mvc\Routing\Matchers\SegmentMatcher;

$router = new Router();

$router->RegisterRoute( new StaticContentRoute(new StaticMatcher(new String("/test.html")), new String("wasah")));
$router->RegisterRoute( new ControllerActionResolverRoute(new SegmentMatcher(new String("{controller}/{action}"), array('controller'=>new String('home'), 'action'=>new String('index'))), new String('MyApp\Controllers')));

$request = HttpRequest::FromServerSuperGlobal();

$route = $router->ResolveRoute($request);

$response = HttpResponse::EmptyResponse();

$route->Execute($request, $response);