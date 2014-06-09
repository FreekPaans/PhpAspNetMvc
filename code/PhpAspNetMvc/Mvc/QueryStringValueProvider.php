<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class QueryStringValueProvider implements IValueProvider {
	private $_context;

 	public function __construct(ControllerContext $context){
 		$this->_context = $context;
 	}
	public function ContainsPrefix(String $prefix) {

	}
	public function GetValue(String $key) {

	}
}