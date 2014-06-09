<?php

namespace PhpAspNetMvc\Mvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Mvc\ModelBinding\ModelBinder;

class ControllerActionResolverRoute implements Route {
	private $_matcher;
	private $_controllerNameSpace;
	
	public function __construct(Matchers\Matcher $matcher, String $controllerNamespace) {
		$this->_matcher = $matcher;
		$this->_controllerNameSpace = $controllerNamespace;
	}

	public function Execute(HttpRequest $request, HttpResponse $response) {
		$controllerName = $this->GetControllerName($request);
		$actionName = $this->GetActionName($request);

		$this->FindActionControllerAndMethod($controllerName,$actionName,$controllerClass,$method);

		$controllerInstance = $controllerClass->newInstance();

		$args = ModelBinder::Bind(new HttpContext($request,$response), $method);

		$actionResult = $method->InvokeArgs($controllerInstance, $args);
	
		$actionResult->Execute($response);
	}

	private function GetControllerName(HttpRequest $request) {
		$match = $this->_matcher->Match($request);

		return $match->getMatchParam('controller');
	}

	private function GetActionName(HttpRequest $request) {
		$match = $this->_matcher->Match($request);

		return $match->getMatchParam('action');	
	}

	private function FindActionControllerAndMethod(String $controllerName,String $actionName, &$outControllerClass, &$outMethod){
		$controllerClassname  = (string)String::Format(new String('{0}\{1}Controller'), $this->_controllerNameSpace, $controllerName->UppercaseFirst());

		if(!class_exists($controllerClassname)) {
			throw new \Exception(String::Format(new String("Class {0} doesn't exist"), $controllerClassname));
		}

		$reflectionClass = new \ReflectionClass($controllerClassname);

		$methodName = $actionName->Concat(new String('Action'));

		if(!$reflectionClass->hasMethod($methodName)) {
			throw new \Exception(String::Format(new String("Method {0} does not exist on {1}"), $methodName,$controllerClassname));
		}

		$method = $reflectionClass->getMethod($methodName);

		if(!$method->isPublic()) {
			throw new \Exception(String::Format(new String("Method {0} is not public"), $method->name));
		}

		if($method->isStatic()) {
			throw new \Exception(String::Format(new String("Method {0} is not an instance method"), $method->name));
		}

		$outControllerClass = $reflectionClass;
		$outMethod = $method;
	}

	public function CanHandle(HttpRequest $request) {
		return $this->_matcher->Matches($request);
	}
}