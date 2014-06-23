<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewResult extends ViewResultBase {
	private $_masterName;

	public function __construct(String $viewName, ViewEngineCollection $viewEngines, ViewDataDictionary $viewData) {
		parent::__construct($viewName,$viewEngines,$viewData);
	}

	public function FindView(ControllerContext $context) {
		return $this->GetViewEngineCollection()->FindView($context, $this->GetViewName(), $this->_masterName);
	}

	public function WithMasterName(String $masterName) {
		$res = new ViewResult($this->GetViewName(), $this->GetViewEngineCollection(), $this->GetViewData());
		$res->_masterName = $masterName;
		return $res;
	}
}