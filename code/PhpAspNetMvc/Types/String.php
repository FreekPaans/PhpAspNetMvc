<?php

namespace PhpAspNetMvc\Types;

class String {

	private $_value;

	public function __construct($value) {
		if(!is_string($value)) {
			throw new Exception(sprintf("not a string: %s", $value));
		}

		$this->_value = $value;
	}

	public function __toString() {
		return $this->_value;
	}
}