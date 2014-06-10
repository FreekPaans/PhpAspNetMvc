<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Routing\RequestContext;

interface IController {
	public function Execute(RequestContext $requestContext);
}