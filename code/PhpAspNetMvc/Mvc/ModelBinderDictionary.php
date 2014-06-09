<?php

namespace PhpAspNetMvc\Mvc;

class ModelBinderDictionary {
	private $_binders;
	private $_default;

	public function __construct() {
		$this->_binders = array();
		$this->_default = null;
	}

	private function AddIfNotExists(IModelBinder $modelBinder) {
		foreach($this->_binders as $binder) {
			if($binder === $modelBinder) {
				return;
			}
		}
		$this->_binders[] = $modelBinder;
	}

	public function SetDefaultModelBinder(IModelBinder $modelBinder) {
		$this->AddIfNotExists($modelBinder);
		$this->_default = $modelBinder;
	}

	public function GetBinder(\ReflectionClass $type) {
		return $this->_default;
	}
}