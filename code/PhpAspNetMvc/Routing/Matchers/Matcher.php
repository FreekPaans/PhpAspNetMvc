<?php

namespace PhpAspNetMvc\Routing\Matchers;

use  PhpAspNetMvc\Http\HttpRequest;

interface Matcher {
	public function Matches(HttpRequest $request);
}