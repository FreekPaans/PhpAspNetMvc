<?php

namespace PhpAspNetMvc\Types;

class Integer {
	private $_value;

	public function __construct($value) {
		if(!is_int($value)) {
			throw new \Exception(String::Format("Not an int: {0}", $value));
		}

		$this->_value = $value;
	}

	public function ToInt() {
		return $this->_value;
	}

	public function __toString() {
		return (string)$this->_value;
	}

	public function Increment() {
		return new Integer($this->_value+1);
	}

	public function IsZero() {
		return $this->_value === 0;
	}
}