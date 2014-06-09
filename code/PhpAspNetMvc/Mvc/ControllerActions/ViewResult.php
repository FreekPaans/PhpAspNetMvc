<?php

namespace PhpAspNetMvc\Mvc\ControllerActions;

use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\String;

class ViewResult implements ActionResult {
	public function __construct(String $message) {
		$this->_message = $message;
	}
	public function Execute(HttpResponse $response) {
		$response->Write($this->_message);
	}
}