<?php

namespace PhpAspNetMvc\Mvc;

class QueryStringValueProviderFactory extends ValueProviderFactory {
	public function __construct() {
		parent::__construct();
	}
	public function GetValueProvider(ControllerContext $context) {
		return new QueryStringValueProvider($context);
	}
}