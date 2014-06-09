<?php

namespace PhpAspNetMvc\Mvc;

abstract class ValueProviderFactory {
	protected function __construct() {}

	public abstract function GetValueProvider(ControllerContext $context);
}