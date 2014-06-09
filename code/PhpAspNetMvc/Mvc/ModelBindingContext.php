<?php

namespace PhpAspNetMvc\Mvc;

class ModelBindingContext {
	private $_valueProvider;
	
	public function __construct(IValueProvider $valueProvider) {
		$this->_valueProvider = $valueProvider;
	}

	public function GetValueProvider() {
		return $this->_valueProvider;
	}
}