<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\ImmutableList;
use PhpAspNetMvc\Types\String;

class ValueProviderFactoryCollection {
	private $_items;

	public function __construct() {
		$this->_items = ImmutableList::CreateNew();
	}

	public function Add(ValueProviderFactory $factory) {
		$this->_items = $this->_items->Add($factory);
	}

	public function GetValueProvider(ControllerContext $controllerContext) {
		$res = $this->_items->Map(function(ValueProviderFactory $item) use($controllerContext) { return $item->GetValueProvider($controllerContext);});

		return new ValueProviderCollection($res);
	}	
}