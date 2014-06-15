<?php

namespace PhpAspNetMvc\Mvc;

class ViewDataDictionary {
	private function __construct() {
		// $this->_model = $model;
	}

	public static function GetEmpty(){
		return new ViewDataDictionary();
	}
}