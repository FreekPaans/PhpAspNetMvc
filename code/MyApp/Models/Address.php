<?php

namespace MyApp\Models;

use PhpAspNetMvc\Types\String;

class Address {
	public function __construct(String $street=null, String $zipcode=null) {
		$this->street = $street;
		$this->zipcode = $zipcode;
	}
}