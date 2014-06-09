<?php

namespace PhpAspNetMvc\Mvc;

class UrlParameter {
	private static $_optional;

	private static $_hasInit;

	public static function Optional() {
		return self::$_optional;
	}

	public static function Init() {
		if(self::$_hasInit) {
			return;
		}

		self::$_hasInit = true;
		self::$_optional = new \stdClass();
	}
}

UrlParameter::Init();