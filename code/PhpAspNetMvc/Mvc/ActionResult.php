<?php

namespace PhpAspNetMvc\Mvc;

abstract class ActionResult {
	protected function __construct() {}

	public abstract function ExecuteResult(ControllerContext $context);
}