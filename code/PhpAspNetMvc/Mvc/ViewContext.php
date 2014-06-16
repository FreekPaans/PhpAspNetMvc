<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\IO\TextWriter;

class ViewContext {
	private $_view;
	private $_writer;
	private $_viewData;
	private $_controllerContext;

	public function __construct(ControllerContext $context, IView $view, ViewDataDictionary $viewData, TextWriter $writer) {
		$this->_controllerContext = $context;
		$this->_view = $view;
		$this->_writer = $writer;
		$this->_viewData = $viewData;
	}

	public function GetViewData() {
		return $this->_viewData;
	}
}