<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ValueProviderCollection implements IValueProvider {
	private $_valueProviders;

	public function __construct(ImmutableList $valueProviders) {
		$this->_valueProviders = $valueProviders;
	}

	public function ContainsPrefix(String $prefix) {
		foreach($this->_valueProviders as $valueProvider) {
			if($valueProvider->ContainsPrefix($prefix)) {
				return true;
			}
		}
		return false;
	}

	public function GetValue(String $key) {
		foreach($this->_valueProviders as $valueProvider) {
			$value = $valueProvider->GetValue($key);
			if($value!==null) {
				return $value;
			}
		}

		return null;
	}
}