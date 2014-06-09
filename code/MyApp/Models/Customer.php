<?php

namespace MyApp\Models;

use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;

class Customer {
	public function __construct(Integer $id, String $name) {
	}
}