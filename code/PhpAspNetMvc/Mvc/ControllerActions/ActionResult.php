<?php

namespace PhpAspNetMvc\Mvc\ControllerActions;

use PhpAspNetMvc\Http\HttpResponse;

interface ActionResult {
	public function Execute(HttpResponse $response);
}