<?php

namespace PhpAspNetMvc\Types;

class Boolean {
	public function __construct($boolean) {
		if(!is_bool($boolean)) {
			throw new \Exception(String::Format(new String("Not a boolean: {0}"), $boolean));
		}

		$this->_value = $boolean;
	}

}