<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class TestViewEngine implements IViewEngine{
	public function FindView(ControllerContext $context, String $viewName, String $masterName) {
		return null;
	}
}