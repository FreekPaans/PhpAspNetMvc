<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

abstract class ViewResultBase extends ActionResult {
	private $_viewName;
	private $_viewEngines;
	private $_viewData;

	protected function __construct(String $viewName, ViewEngineCollection $viewEngines, ViewDataDictionary $viewData) {
		$this->_viewName = $viewName;
		$this->_viewEngines = $viewEngines;
		$this->_viewData = $viewData;
	}

	public function ExecuteResult(ControllerContext $context) {
		$viewEngineResult = $this->FindView($context);

		$view = $viewEngineResult->GetView();

		if($view === null) {
			throw new \Exception(string::Format(new String("Couldn't find view, looked in:\n{0}"), String::Join(new String("\n"), $viewEngineResult->GetSearchedLocations())));
		}

		$writer = $context->GetHttpContext()->GetResponse()->GetTextWriter();

		$view->Render(
			new ViewContext(
				$context,
				$view,
				$this->_viewData, 
				$writer
			),
			$writer
		);
	}

	protected function GetViewData() {
		return $this->_viewData;
	}

	protected function GetViewEngineCollection() {
		return $this->_viewEngines;
	}

	protected abstract function FindView(ControllerContext $context);

	protected function GetViewName() {
		return $this->_viewName;
	}
}