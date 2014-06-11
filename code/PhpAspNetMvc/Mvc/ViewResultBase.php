<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

abstract class ViewResultBase extends ActionResult {
	public $viewDataDictionary;

	protected function __construct() {
		$this->viewDataDictionary = new ViewDataDictionary();
	}

	public function ExecuteResult(ControllerContext $context) {
		$viewEngineResult = $this->FindView($context);

		$view = $viewEngineResult->GetView();

		if($view === null) {
			throw new \Exception(string::Format(new String("Couldn't find view, looked in:\n{0}"), String::Join(new String("\n"), $viewEngineResult->GetSearchedLocations())));
		}

		$view->Render(new ViewContext($context,$view,$viewDataDictionary, $context->GetHttpContext()->GetHttpReponse()->GetTextWriter()));
	}

	protected abstract function FindView(ControllerContext $context);
}