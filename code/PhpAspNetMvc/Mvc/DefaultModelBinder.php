<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;

class DefaultModelBinder implements IModelBinder {
	public function BindModel(ControllerContext $controllerContext, ModelBindingContext $bindingContext) {
		if(!$bindingContext->GetValueProvider()->ContainsPrefix($bindingContext->GetModelName())) {
			return null;
		}

		$converters = self::getTypeConverters();
		$value = $bindingContext->GetValueProvider()->GetValue($bindingContext->GetModelName());
		$typeKey = $bindingContext->GetModelType()->getName();

		if(!array_key_exists($typeKey, $converters)) {
			return null;
		}

		return $converters[$typeKey]($value);
	}

	private static function getTypeConverters() {
		$res = array();
		$res['PhpAspNetMvc\Types\Integer'] = function($stringValue) {
			return new Integer(intval((string)$stringValue));
		};

		$res['PhpAspNetMvc\Types\String'] = function($stringValue) {
			return new String((string)$stringValue);
		};

		return $res;
	}
}