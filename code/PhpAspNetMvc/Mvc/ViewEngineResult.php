<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;

class ViewEngineResult {
	private $_view;
	private $_searchedLocations;
	private $_viewEngine;

	private function __construct() {
	}

	public static function Found(IView $view, IViewEngine $engine) {
		$res = new ViewEngineResult();

		$res->_view = $view;
		$res->_viewEngine = $engine;

		return $res;
	}

	public static function NotFound(ImmutableList $locations) {
		$res = new ViewEngineResult();

		$res->_view = null;
		$res->_viewEngine = null;
		$res->_searchedLocations = $locations;

		return $res;
	}

	public function GetSearchedLocations() {
		return $this->_searchedLocations;
	}

	public function GetView() {
		return $this->_view;
	}
}