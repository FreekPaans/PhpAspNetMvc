<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class TestViewEngine implements IViewEngine{
	public function FindView(ControllerContext $context, String $viewName, String $masterName=null) {
		return ViewEngineResult::NotFound(ImmutableList::FromParams(new String('test'), new String('test2')));
	}
}