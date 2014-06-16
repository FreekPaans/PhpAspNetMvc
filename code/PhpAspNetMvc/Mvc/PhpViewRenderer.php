<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class PhpViewRenderer {
	private $Model;

	public function __construct(ViewDataDictionary $viewData) {
		$this->Model = $viewData->GetModel();
	}

	public function Render(String $filename) {
		ob_start();

		include $filename;

		$result = ob_get_clean();

		return new String($result);
	}
}