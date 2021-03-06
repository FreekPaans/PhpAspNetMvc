<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Routing\RequestContext;
use PhpAspNetMvc\Types\String;

class ControllerBase implements IController {
	private $_requestContext;
	private $_viewData;

	private function GetViewData() {
		$this->AssertViewData();
		return $this->_viewData;
	}

	private function AssertViewData() {
		if($this->_viewData!==null) {
			return;
		}
		$this->_viewData = ViewDataDictionary::GetEmpty();
	}

	public function Execute(RequestContext $context) {
		$this->_requestContext = $context;

		$actionName = $context->GetRouteData()->GetRequiredString('action');

		$methodName = $actionName->Concat(new String('Action'));

		$reflectionClass = new \ReflectionClass($this);

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

		$args = $this->GetControllerActionParams($context, $method);

		$actionResult = $method->InvokeArgs($this, $args);

		if($actionResult === null){
			return;
		}
	
		if(!($actionResult instanceof ActionResult)) {
			throw new \Exception("Action must return an object that derives from ActionResult");
		}

		$actionResult->ExecuteResult($this->GetControllerContext($context));

		// $context->GetHttpContext()->GetResponse()->Write(new String('Hello world!!'));
	}


	private function GetControllerContext(RequestContext $requestContext) {
		return new ControllerContext($requestContext, $this);
	}

	private function GetControllerActionParams(RequestContext $requestContext, \ReflectionMethod $method) {
		$parms = array();

		$controllerContext = $this->GetControllerContext($requestContext);

		$valueProvider = ValueProviderFactories::GetFactories()->GetValueProvider($controllerContext);

		foreach($method->getParameters() as $parameter) {
			$modelBindingContext = new ModelBindingContext($valueProvider, $parameter->getClass(), new String($parameter->name));
			$parms[] = ModelBinders::GetBinders()->GetBinder($parameter->GetClass())->BindModel($controllerContext,$modelBindingContext);
		}

		return $parms;
	}

	protected function Content(String $content, String $contentType=null) {
		return new ContentResult($content,$contentType);
	}


	protected function View() {
		return $this->ViewWithModel(null);
	}

	protected function ViewWithModel($model=null) {
		return $this->ViewWithViewNameWithMasterNameWithModel($this->_requestContext->GetRouteData()->GetRequiredString('action'), null, $model);
	}

	protected function ViewWithViewNameWithMasterNameWithModel(String $viewName, String $masterName=null, $model=null) {
		$viewData = $this->GetViewData();

		if($model!==null) {
			$viewData = $viewData->WithModel($model);
		}

		$res = new ViewResult(
			$this->_requestContext->GetRouteData()->GetRequiredString('action'), 
			ViewEngines::GetEngines(),
			$viewData
		);

		if($masterName!==null) {
			$res = $res->WithMasterName($masterName);
		}

		return $res;
	}

	protected function SetViewDataItem($key, $value) {
		$this->_viewData = $this->GetViewData()->AddItem($key, $value);
	}
}