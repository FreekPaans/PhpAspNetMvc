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

	public function UppercaseFirst() {
		return new String(ucfirst($this->_value));
	}

	public function Concat(String $toConcat) {
		return new String($this->_value.$toConcat->_value);
	}

	public function Split(String $splitOn) {
		$removeEmpty = FALSE;
		if(func_num_args()>1) {
			$removeEmpty = func_get_arg(1) === TRUE;
		}
		$mapped = ImmutableList::FromArray(explode($splitOn->_value,$this->_value))->Map(function($str) { return new String($str); });

		if(!$removeEmpty) {
			return $mapped;
		}
		return $mapped->Filter(function($item) { return !$item->IsEmpty();});
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

	public function IsEmpty() {
		return strlen($this->_value)===0;
	}

	public function Equals(String $compareTo) {
		return $this->_value === $compareTo->_value;
	}
}