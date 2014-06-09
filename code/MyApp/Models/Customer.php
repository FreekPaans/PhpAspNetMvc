<?php

namespace MyApp\Models;

use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;

class Customer {
	private $id;
	
	public function __construct(Integer $id, String $name, Address $address=null) {
		$this->id = $id;
	}

	public function GetId() {
		return $this->id;
	}
}