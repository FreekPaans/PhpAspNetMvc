<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Http\IHttpHandler;
use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Routing\RequestContext;
use PhpAspNetMvc\Types\String;

class MvcHandler implements IHttpHandler{
	private $_requestContext;
	private $_controllerNameSpace;

	public function __construct(RequestContext $context, String $controllerNamespace) {
		$this->_requestContext = $context;
		$this->_controllerNameSpace = $controllerNamespace;
	}

	public function ProcessRequest(HttpContext $context) {
		$controllerName = $this->_requestContext->GetRouteData()->GetRequiredString('controller');
		
		$controllerClass = $this->FindController($controllerName);

		$controllerInstance = $controllerClass->newInstance();

		if(!($controllerInstance instanceof IController)) {
			throw new \Exception(String::Format(new String("controller {0} not an instance of IController"), $controllerClass->name));
		}

		$controllerInstance->Execute($this->_requestContext);

		// $actionName = $this->_requestContext->GetRouteData()->GetRequiredString('action');

		// $args = $this->GetControllerActionParams($method);

		// $actionResult = $method->InvokeArgs($controllerInstance, $args);
	
		// $actionResult->Execute($context->GetResponse());
	}

	// private function GetControllerActionParams(\ReflectionMethod $method) {
	// 	$parms = array();

	// 	$controllerContext = new ControllerContext($this->_requestContext->GetHttpContext());

	// 	$valueProvider = ValueProviderFactories::GetFactories()->GetValueProvider($controllerContext);

	// 	foreach($method->getParameters() as $parameter) {
	// 		$modelBindingContext = new ModelBindingContext($valueProvider, $parameter->getClass(), new String($parameter->name));
	// 		$parms[] = ModelBinders::GetBinders()->GetBinder($parameter->GetClass())->BindModel($controllerContext,$modelBindingContext);
	// 	}

	// 	return $parms;
	// }

	// private function GetControllerName(HttpRequest $request) {
	// 	$match = $this->_matcher->Match($request);

	// 	return $match->getMatchParam('controller');
	// }

	// private function GetActionName(HttpRequest $request) {
	// 	$match = $this->_matcher->Match($request);

	// 	return $match->getMatchParam('action');	
	// }

	private function FindController(String $controllerName){
		$controllerClassname  = (string)String::Format(new String('{0}\{1}Controller'), $this->_controllerNameSpace, $controllerName->UppercaseFirst());

		if(!class_exists($controllerClassname)) {
			throw new \Exception(String::Format(new String("Class {0} doesn't exist"), $controllerClassname));
		}

		$reflectionClass = new \ReflectionClass($controllerClassname);

		return $reflectionClass;

		// $methodName = $actionName->Concat(new String('Action'));

		// if(!$reflectionClass->hasMethod($methodName)) {
		// 	throw new \Exception(String::Format(new String("Method {0} does not exist on {1}"), $methodName,$controllerClassname));
		// }

		// $method = $reflectionClass->getMethod($methodName);

		// if(!$method->isPublic()) {
		// 	throw new \Exception(String::Format(new String("Method {0} is not public"), $method->name));
		// }

		// if($method->isStatic()) {
		// 	throw new \Exception(String::Format(new String("Method {0} is not an instance method"), $method->name));
		// }

		// $outControllerClass = $reflectionClass;
		// $outMethod = $method;
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

	// public function CanHandle(HttpRequest $request) {
	// 	return $this->_matcher->Matches($request);
	// }
}