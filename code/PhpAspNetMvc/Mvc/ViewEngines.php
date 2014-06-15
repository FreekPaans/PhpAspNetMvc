<?php

namespace PhpAspNetMvc\Mvc;

class ViewEngines {
	private static $_engines=null;

	public static function GetEngines() {
		self::AssertEngines();

		return self::$_engines;
	}

	private static function AssertEngines() {
		if(self::$_engines!==null ) {
			return;
		}

		self::$_engines = new ViewEngineCollection();
	}
}