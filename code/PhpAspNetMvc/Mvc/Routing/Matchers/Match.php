<?php

namespace PhpAspNetMvc\Mvc\Routing\Matchers;

use  PhpAspNetMvc\Types\String;

class Match {
	private $_params;

	public function __construct(array $params) {
		foreach($params as $val) {
			if(!$val instanceof String) {
				throw new \Exception(String::Format(new String("Values must be instance of string, was: {0}"), gettype($val)));
			}
		}
		$this->_params = $params;
	}

	public function GetMatchParam($key) {
		if(!isset($this->_params[$key])) {
			throw new \Exception(String::Format(new String('Unknown match parameter: {0}'), $key));
		}

		return $this->_params[$key];
	}	
}