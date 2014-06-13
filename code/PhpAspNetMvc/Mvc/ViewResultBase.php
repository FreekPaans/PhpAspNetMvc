<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

abstract class ViewResultBase extends ActionResult {
	private $_viewName;
	private $_viewEngines;



	protected function __construct(String $viewName, ImmutableList $viewEngines) {
		$this->_viewName = $viewName;
		$this->_viewEngines = $viewEngines;
	}

	public function ExecuteResult(ControllerContext $context) {
		$viewEngineResult = $this->FindView($context);

		$view = $viewEngineResult->GetView();

		if($view === null) {
			throw new \Exception(string::Format(new String("Couldn't find view, looked in:\n{0}"), String::Join(new String("\n"), $viewEngineResult->GetSearchedLocations())));
		}

		$view->Render(new ViewContext($context,$view,$viewDataDictionary, $context->GetHttpContext()->GetHttpReponse()->GetTextWriter()));
	}

	protected function GetViewEngines() {
		return $this->_viewEngines;
	}

	protected abstract function FindView(ControllerContext $context);
}