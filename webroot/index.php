<?php

include '../code/thirdparty/Autoload/SplClassLoader.php';

(new SplClassLoader('PhpAspNetMvc', '../code/'))->register();


use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Routing\Router;
use PhpAspNetMvc\Routing\StaticContentRoute;
use PhpAspNetMvc\Routing\ControllerActionResolverRoute;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Routing\Matchers\StaticMatcher;
use PhpAspNetMvc\Routing\Matchers\AllMatcher;

$router = new Router();

$router->RegisterRoute( new StaticContentRoute(new StaticMatcher(new String("/test.html")), new String("wasah")));
$router->RegisterRoute( new ControllerActionResolverRoute(new AllMatcher()));

$request = HttpRequest::FromServerSuperGlobal();

$route = $router->ResolveRoute($request);

$response = HttpResponse::EmptyResponse();

$route->Execute($request, $response);