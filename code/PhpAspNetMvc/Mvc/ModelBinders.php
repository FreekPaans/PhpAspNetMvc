<?php

namespace PhpAspNetMvc\Mvc;

class ModelBinders {
	private static $_binders=null;
	public static function GetBinders() {
		self::AssertBinders();

		return self::$_binders;
	}

	private static function AssertBinders() {
		if(self::$_binders!==null ) {
			return;
		}
		self::$_binders = new ModelBinderDictionary();
		self::$_binders->SetDefaultModelBinder(new DefaultModelBinder());
	}
}