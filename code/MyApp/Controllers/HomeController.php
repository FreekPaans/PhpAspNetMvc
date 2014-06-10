<?php

namespace MyApp\Controllers;

use PhpAspNetMvc\Mvc\ControllerActions\ViewResult;

use PhpAspNetMvc\Mvc\ControllerBase;
use PhpAspNetMvc\Routing\RequestContext;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;
use MyApp\Models\Customer;

class HomeController extends ControllerBase{
	public function indexAction(Customer $customer) {
		return $this->Content(String::Format(
			new String("id: {0}, name: {1}, street: {2}, zipcode: {3}"), 
			$customer->GetId(), 
			$customer->name, 
			$customer->address->street, 
			$customer->address->zipcode
		), new String('text/plain'));
	}
}