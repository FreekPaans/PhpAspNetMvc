<?php

namespace MyApp\Controllers;

use PhpAspNetMvc\Mvc\ControllerActions\ViewResult;

class HomeController {
	public function indexAction() {
		return new ViewResult();
	}
}