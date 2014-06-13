<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ViewEngineCollection {
	private $_viewEngines;

	public function __construct() {
		$this->_viewEngines = ImmutableList::CreateNew();
	}

	public function Add(IViewEngine $engine) {
		$this->_viewEngines = $this->_viewEngines->Add($engine);
	}
}