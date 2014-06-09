<?php

namespace PhpAspNetMvc\Mvc\ModelBinding;

use PhpAspNetMvc\Types\String;

class CallableTypeConverter {
	private $_converter;

	public function __construct(callable $converter) {
		if($converter===null) {
			throw new \Exception("Callable is null");
		}


		$this->_converter = $converter;
	}

	public function Convert(String $value) {
		return call_user_func($this->_converter, (string)$value);
	}
}