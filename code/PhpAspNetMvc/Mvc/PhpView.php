<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\IO\TextWriter;
use PhpAspNetMvc\Types\String;

class PhpView implements IView {
	private $_viewFile;

	public function __construct(String $viewFile) {
		$this->_viewFile = $viewFile;
	}

	public function Render(ViewContext $viewContext, TextWriter $writer) {
		$content = (new PhpViewRenderer($viewContext->GetViewData()))->Render($this->_viewFile);
		$writer->Write($content);
	}

}