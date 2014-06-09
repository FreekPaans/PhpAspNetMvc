<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class ModelBindingContext {
	private $_valueProvider;
	private $_modelName;
	private $_modelType;

	public function __construct(IValueProvider $valueProvider, \ReflectionClass $modelType, String $modelName) {
		$this->_valueProvider = $valueProvider;
		$this->_modelType = $modelType;
		$this->_modelName = $modelName;
	}

	public function GetModelType() {
		return $this->_modelType;
	}

	public function GetModelName() {
		return $this->_modelName;
	}

	public function GetValueProvider() {
		return $this->_valueProvider;
	}

	public function ForNewParameter(String $modelName, \ReflectionClass $type) {
		return new ModelBindingContext($this->_valueProvider, $type, $modelName);
	}
}