<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

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

		$method = $this->FindActionMethod($controllerName,$actionName);
	
		$response->Write(new String('test'));
	}

	private function GetControllerName(HttpRequest $request) {
		$match = $this->_matcher->Match($request);

		return $match->getMatchParam('controller');
	}

	private function GetActionName(HttpRequest $request) {
		$match = $this->_matcher->Match($request);

		return $match->getMatchParam('action');	
	}

	private function FindActionMethod(String $controllerName,String $actionName){
		$controllerClassname  = (string)String::Format(new String('{0}\{1}Controller'), $this->_controllerNameSpace, $controllerName->UppercaseFirst());

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

		return $method;
	}

	public function CanHandle(HttpRequest $request) {
		return $this->_matcher->Matches($request);
	}
}