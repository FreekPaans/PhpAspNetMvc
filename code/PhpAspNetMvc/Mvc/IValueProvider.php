<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

interface IValueProvider {
	public function ContainsPrefix(String $prefix);
	public function GetValue(String $key);
}