<?php

namespace PhpAspNetMvc\Routing\Matchers;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Types\String;

class AllMatcher implements Matcher{
	public function __construct() {
	}

	public function Matches(HttpRequest $request) {
		return true;
	}
}