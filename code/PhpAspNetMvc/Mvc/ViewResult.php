<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewResult extends ViewResultBase {
	public $masterName;

	public function __construct(String $viewName, ViewEngineCollection $viewEngines) {
		parent::__construct($viewName,$viewEngines);
	}

	public function FindView(ControllerContext $context) {
		return $this->GetViewEngineCollection()->FindView($context, $this->GetViewName(), $this->masterName);
	}
}