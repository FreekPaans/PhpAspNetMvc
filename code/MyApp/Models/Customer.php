<?php

namespace MyApp\Models;

use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;

class Customer {
	public function __construct(Integer $id, String $name, Address $address=null) {
		$this->id = $id;
		$this->name = $name;
		$this->address = $address;
	}
}