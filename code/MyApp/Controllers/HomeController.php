<?php

namespace MyApp\Controllers;

use PhpAspNetMvc\Mvc\ControllerActions\ViewResult;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;

class HomeController {
	public function indexAction(Integer $id, String $name) {
		return new ViewResult(String::Format(new String("id: {0}, name: {1}"), $id, $name));
	}
}