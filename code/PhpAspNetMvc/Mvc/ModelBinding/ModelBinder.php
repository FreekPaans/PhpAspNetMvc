<?php

namespace PhpAspNetMvc\Mvc\ModelBinding;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;

class ModelBinder {
	private static function getTypeConverters() {
		$res = array();
		$res['PhpAspNetMvc\Types\Integer'] = new CallableTypeConverter(function($stringValue) {
			return new Integer(intval((string)$stringValue));
		});

		$res['PhpAspNetMvc\Types\String'] = new CallableTypeConverter(function($stringValue) {
			return new String((string)$stringValue);
		});

		return $res;
	}

	public static function Bind(HttpRequest $request, \ReflectionMethod $method) {
		$params = array();

		$typeConverters = self::getTypeConverters();

		foreach($method->getParameters() as $parameter) {
			$paramType = $parameter->getClass()->name;
			if(!array_key_exists($paramType , $typeConverters)) {
				continue;
			}

			if($request->GetQueryString()->TryGetValue($parameter->getName(), $value)===false) {
				continue;
			}
			
			$params[$parameter->getName()] = $typeConverters[$paramType]->Convert($value);
		}

		return $params;
	}
}