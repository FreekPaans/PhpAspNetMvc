<?php

namespace PhpAspNetMvc\Mvc;
namespace PhpAspNetMvc\IO\TextWriter;

class ControllerContext {
	public $view, $writer, $viewData;
	private $_context;
	public function __construct(ControllerContext $context, IView $view, ViewDataDictionary $viewData, TextWriter $writer) {
		$this->_context = $context;
		$this->view = $view;
		$this->writer = $writer;
		$this->viewData = $viewData;
	}
}