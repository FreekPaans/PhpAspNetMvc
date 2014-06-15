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
		$routeData= $context->GetRouteData();

		$baseFilename = String::Format(new String("{0}/{1}/{2}"), 
			$this->_basePath,
			$routeData->GetRequiredString('controller'),
			$viewName
		);

		$locations = ImmutableList::FromParams(
			String::Format(new String("{0}.php"), $baseFilename),
			String::Format(new String("{0}.phtml"), $baseFilename)
		);

		foreach($locations as $location) {
			if(file_exists($location)) {
				return $this->ViewFromFile($location);
			}
		}

		return ViewEngineResult::NotFound($locations);
	}

	public function ViewFromFile(String $filename) {
		return ViewEngineResult::Found(new PhpView($filename), $this);
	}
}