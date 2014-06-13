<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewResult extends ViewResultBase {
	public $masterName;

	public function __construct() {}

	public function FindView(ControllerContext $context) {
		return $this->GetEngines()->FindView($context, $this->viewName, $this->masterName);
		//return ViewEngineResult::NotFound(ImmutableList::CreateNew(new String('test'), new String('test2')));
	}
}