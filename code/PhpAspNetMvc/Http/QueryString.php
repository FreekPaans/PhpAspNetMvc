<?php


namespace PhpAspnetMvc\Http;

use PhpAspnetMvc\Types\String;
use PhpAspnetMvc\Types\Integer;
use PhpAspnetMvc\Types\ImmutableList;

class QueryString {
	private $_nameValues;

	public function __construct(String $queryString) {
		$map = array();

		if($queryString->StartsWith(new String("?"))) {
			$queryString = $queryString->Substring(new Integer(1));
		}

		foreach($queryString->Split(new String('&'),true)->Map(function(String $el) { return new String(urldecode((string)$el)); }) as $nameValuePair) {
			$spl = $nameValuePair->Split(new String('='));
			$map[(string)$spl->ItemAt(new Integer(0))] = $spl->ItemAt(new Integer(1));
		}

		$this->_nameValues = $map;
	}

	public function TryGetValue($key, &$value) {
		if(!is_string($key)) {
			throw new \Exception(String::Format(new String("Key should be string, is {0}"), gettype($key)));
		}
		if(!array_key_exists($key,$this->_nameValues)) {
			return false;
		}

		$value = $this->_nameValues[$key];

		return true;
	}

	public function GetAllKeys() {
		return ImmutableList::FromArray(array_keys($this->_nameValues))->Map(function($str) { return new String($str); });
	}
}