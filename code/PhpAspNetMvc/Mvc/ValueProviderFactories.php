<?php

namespace PhpAspNetMvc\Mvc;

class ValueProviderFactories {
	private static $_factories = null;
	public static function GetFactories() {
		self::AssertFactories();

		return self::$_factories;
	}

	private static function AssertFactories() {
		if(self::$_factories!==null) {
			return;
		}
		self::$_factories = new ValueProviderFactoryCollection();
		self::$_factories->Add(new QueryStringValueProviderFactory());
	}
}