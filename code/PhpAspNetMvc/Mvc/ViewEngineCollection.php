<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewEngineCollection {
	private $_viewEngines;

	public function __construct() {
		$this->_viewEngines = ImmutableList::CreateNew();
	}

	public function Add(IViewEngine $engine) {
		$this->_viewEngines = $this->_viewEngines->Add($engine);
	}

	public function FindView(ControllerContext $context, String $viewName, String $masterName=null) {
		$notFound = ImmutableList::CreateNew();

		foreach($this->_viewEngines as $engine) {
			$viewEngineResult = $engine->FindView($context, $viewName, $masterName);
			if($viewEngineResult->GetView()!==null) {
				return $viewEngineResult;
			}

			$notFound = $notFound->Concat($viewEngineResult->GetSearchedLocations());
		}

		return ViewEngineResult::NotFound($notFound);
	}
}