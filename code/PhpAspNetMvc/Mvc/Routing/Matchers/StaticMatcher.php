<?php

namespace PhpAspNetMvc\Mvc\Routing\Matchers;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Types\String;

class StaticMatcher implements Matcher{
	private $_path;

	public function __construct(String $path) {
		$this->_path = $path;
	}

	public function Matches(HttpRequest $request) {
		return $this->_path == $request->GetUri()->GetPath();
	}

	public function Match(HttpRequest $request) {
		return new Match(array());
	}
}