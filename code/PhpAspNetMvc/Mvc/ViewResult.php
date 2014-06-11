<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewResult extends ViewResultBase {
	public function __construct() {}

	public function FindView(ControllerContext $context) {
		return ViewEngineResult::NotFound(ImmutableList::CreateNew(new String('test'), new String('test2')));
	}
}