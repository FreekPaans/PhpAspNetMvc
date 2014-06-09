<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Http\HttpContext;

class ControllerContext {
	public function __construct(HttpContext $context) {
		$this->_context = $context;
	}

	public function GetHttpContext() {
		return $this->_context;
	}
}