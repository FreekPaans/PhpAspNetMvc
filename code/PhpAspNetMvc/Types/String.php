<?php

namespace PhpAspNetMvc\Types;

class String {
	private $_value;

	public function __construct($value) {
		if(!is_string($value)) {
			throw new \Exception(sprintf("not a string: %s", $value));
		}

		$this->_value = $value;
	}

	public function __toString() {
		return $this->_value;
	}

	public function Contains(String $needle) {
		return strpos($this->_value,$needle->_value)!==FALSE;
	}

	public function IndexOf(String $needle) {
		$pos = strpos($this->_value,$needle->_value);
		if($pos===FALSE) {
			return new Integer(-1);
		}
		return new Integer($pos);
	}

	public function Substring(Integer $start, Integer $numCharacters) {
		return substr($this->_value, $start->ToInt(), $numCharacters->ToInt());
	}

	public static function Format(String $format) {
		$allArgs = func_get_args();

		$i=0;

		$workString = $format->_value;

		while(true) {
			$idx = "{".$i."}";

			if(!$format->Contains(new String($idx))) {
				break;
			}

			$replaced = str_replace($idx, (string)func_get_arg($i+1),$workString);

			if($replaced == $workString) {
				break;
			}

			$workString = $replaced;

			$i++;
		}

		return new String($workString);
	}
}