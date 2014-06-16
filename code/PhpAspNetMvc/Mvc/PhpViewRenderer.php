<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class PhpViewRenderer {
	private $Model;
	private $_viewData;

	public function __construct(ViewDataDictionary $viewData) {
		$this->Model = $viewData->GetModel();
		$this->_viewData = $viewData;
	}

	public function EchoItem($itemKey) {
		if(!$this->_viewData->ContainsItem($itemKey)) {
			return null;
		}

		echo htmlspecialchars($this->_viewData->GetItem($itemKey));
	}

	public function Render(String $filename) {
		ob_start();

		include $filename;

		$result = ob_get_clean();

		return new String($result);
	}
}