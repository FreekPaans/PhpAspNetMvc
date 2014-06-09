<?php


namespace PhpAspnetMvc\Http;

use PhpAspnetMvc\Types\String;
use PhpAspnetMvc\Types\Integer;

class QueryString {
	private $_nameValues;

	public function __construct(String $queryString) {
		$map = array();

		if($queryString->StartsWith(new String("?"))) {
			$queryString = $queryString->Substring(new Integer(1));
		}

		foreach($queryString->Split(new String('&')) as $nameValuePair) {
			$spl = $nameValuePair->Split(new String('='));
			$map[(string)$spl->ItemAt(new Integer(0))] = $spl->ItemAt(new Integer(1));
		}

		$this->_nameValues = $map;
	}

	public function TryGetValue($key, &$value) {
		if(!array_key_exists($key,$this->_nameValues)) {
			return false;
		}

		$value = $this->_nameValues[$key];

		return true;
	}
}