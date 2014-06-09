<?php

namespace PhpAspNetMvc\Http;

use PhpAspNetMvc\Types\String;

interface IHttpHandler {
	public function ProcessRequest(HttpContext $context);
}