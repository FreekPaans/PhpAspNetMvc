<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class PhpViewEngine implements IViewEngine{
	private $_basePath;
	public function __construct(String $basePath) {
		if(!file_exists($basePath)) {
			throw new \Exception(String::Format(new String("Path {0} doesn't exist"), $basePath));
		}

		$this->_basePath = new String(realpath($basePath));
	}
	public function FindView(ControllerContext $context, String $viewName, String $masterName=null) {
		$viewFilename = $this->ObtainViewLocation($context, $viewName);

		if($viewFilename===null ){
			return ViewEngineResult::NotFound($this->CalculateViewSearchLocations($context,$viewName));
		}

		$view = $this->ViewFromFile($viewFilename);

		if($masterName===null) {
			return $view;
		}

		$masterViewFilename = $this->ObtainViewLocation($context,$masterName);

		if($masterViewFilename===null) {
			return ViewEngineResult::NotFound($this->CalculateViewSearchLocations($context,$masterName));
		}

		$masterView = $this->ViewFromFile($masterViewFilename);

		$view->SetMaster($masterView);

		return $view;
	}

	private function ObtainViewLocation(ControllerContext $context, String $viewName) {
		$viewSearchLocations = $this->CalculateViewSearchLocations($context,$viewName);
		foreach($viewSearchLocations as $location) {
			if(file_exists($location)) {
				return $location;
				
			}
		}
		return null;
	}

	private function CalculateViewSearchLocations(ControllerContext $context, String $viewName) {
		$controllerFilename = $this->CalculateControllerBasedFilename($context,$viewName);
		$sharedFilename = $this->CalculateSharedBasedFilename($viewName);

		return ImmutableList::FromParams(
			String::Format(new String("{0}.php"), $controllerFilename),
			String::Format(new String("{0}.phtml"), $controllerFilename),
			String::Format(new String("{0}.php"), $sharedFilename),
			String::Format(new String("{0}.phtml"), $sharedFilename)
		);
	}

	private function CalculateControllerBasedFilename(ControllerContext $context, String $viewName) {
		$routeData= $context->GetRouteData();

		return $this->CalculateViewFilename($routeData->GetRequiredString('controller'), $viewName);
	}

	private function CalculateSharedBasedFilename(String $viewName) {
		return $this->CalculateViewFilename(new String('shared'), $viewName);
	}

	private function CalculateViewFilename(String $subPath, String $viewName) {
		return String::Format(new String("{0}/{1}/{2}"), 
			$this->_basePath,
			$subPath,
			$viewName
		);
	}


	public function ViewFromFile(String $filename) {
		return ViewEngineResult::Found(new PhpView($filename), $this);
	}
}