<?php

namespace MyApp\Controllers;

use PhpAspNetMvc\Mvc\ControllerActions\ViewResult;

use PhpAspNetMvc\Mvc\IController;
use PhpAspNetMvc\Routing\RequestContext;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;
use MyApp\Models\Customer;

class HomeController implements IController{
	public function Execute(RequestContext $context) {
		$context->GetHttpContext()->GetResponse()->Write(new String('Hello world!!'));
	}

	public function indexAction(Customer $customer) {
		return new ViewResult(String::Format(
			new String("id: {0}, name: {1}, street: {2}, zipcode: {3}"), 
			$customer->GetId(), 
			$customer->name, 
			$customer->address->street, 
			$customer->address->zipcode
		));
	}
}