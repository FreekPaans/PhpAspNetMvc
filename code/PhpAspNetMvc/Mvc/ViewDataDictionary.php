<?php

namespace PhpAspNetMvc\Mvc;

class ViewDataDictionary {
	private $_model;

	private function __construct($model=null) {
		$this->_model = $model;
	}

	public static function GetEmpty(){
		return new ViewDataDictionary();
	}

	public function WithModel($model) {
		return new ViewDataDictionary($model);
	}

	public function GetModel() {
		return $this->_model;
	}
}