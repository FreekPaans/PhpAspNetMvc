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

	public function Substring(Integer $start, Integer $numCharacters=null) {
		if($start==$this->GetLength()) {
			return new String("");
		}

		if($numCharacters===null) {
			return new String(substr($this->_value, $start->ToInt()));
		}

		return new String(substr($this->_value, $start->ToInt(), $numCharacters->ToInt()));
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
		return $this->GetLength()->IsZero();
	}

	public function Equals(String $compareTo) {
		return $this->_value === $compareTo->_value;
	}

	public function GetLength() {
		return new Integer(strlen($this->_value));
	}

	public function StartsWith(String $value) {
		return $this->Substring(new Integer(0), $value->GetLength())->Equals($value);
	}

	public function Append(String $append) {
		return new String($this->_value.$append->_value);
	}

	public static function Join(String $separator, ImmutableList $list) {
		$res = new String("");

		foreach($list as $item) {
			$res = $res->Append($item)->Append($separator);
		}

		return $res;
	}
}