<?php

include '../code/thirdparty/Autoload/SplClassLoader.php';

(new SplClassLoader('PhpAspNetMvc', '../code/'))->register();


use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Routing\Router;

$request = HttpRequest::FromServerSuperGlobal();

$route = Router::ResolveRoute($request);

$response = HttpResponse::EmptyResponse();

$route->Execute($request, $response);