<?php

namespace PhpAspNetMvc\Mvc;

class ViewDataDictionary {
	public function __construct(object $model) {
		$this->_model = $model;
	}
}