<?php

namespace PhpAspNetMvc\Mvc\ControllerActions;

use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

class ViewResult implements ActionResult {
	public function Execute(HttpResponse $response) {
		$response->Write(new String('wassah'));
	}
}