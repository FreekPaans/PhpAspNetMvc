<?php

namespace PhpAspNetMvc\Mvc;
use PhpAspNetMvc\Types\String;

class ValueProviderResult {
	protected function __construct(String $value) {
		$this->_value  = $value;
	}
}