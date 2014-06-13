<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

interface IViewEngine {
	public function FindView(ControllerContext $context, String $viewName, String $masterName);
}
