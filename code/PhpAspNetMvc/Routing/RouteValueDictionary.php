<?php

namespace PhpAspNetMvc\Routing;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\ImmutableList;

class RouteValueDictionary {
	private  function __construct($map) {
		$this->_map = $map;
	}

	public static function FromArray(array $array) {
		return new RouteValueDictionary($array);
	}

	public static function CreateNew() {
		return new RouteValueDictionary(array());
	}

	public function ContainsKey($key) {
		self::AssertKey($key);

		return array_key_exists($key,$this->_map);
	}

	private static function AssertKey($key) {
		if(!is_string($key)) {
			throw new \Exception(String::Format("Key must be a PHP string"));
		}
	}

	public function Add($key, $value) {
		self::AssertKey($key);

		if($this->ContainsKey($key)) {
			throw new \Exception(String::Format(new String("Key {0} already exist"), $key));
		}

		$newMap = $this->_map;

		$newMap[$key] = $value;
		return self::FromArray($newMap);
	}

	public function GetItem($key) {
		self::AssertKey($key);

		if(!$this->ContainsKey($key)) {
			throw new \Exception(String::Format(new String("Key {0} not found"), $key));
		}

		return $this->_map[$key];
	}
}