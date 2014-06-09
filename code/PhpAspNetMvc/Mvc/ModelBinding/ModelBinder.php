<?php

namespace PhpAspNetMvc\Mvc\ModelBinding;

use PhpAspNetMvc\Http\HttpRequest;
use PhpAspNetMvc\Http\HttpResponse;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Mvc\ModelBinders;
use PhpAspNetMvc\Mvc\ModelBindingContext;
use PhpAspNetMvc\Mvc\ControllerContext;
use PhpAspNetMvc\Mvc\ValueProviderFactories;

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

	public static function Bind(HttpRequest $request, \ReflectionMethod $method)  {
		$parms = array();

		$controllerContext = new ControllerContext();

		$valueProvider = ValueProviderFactories::GetFactories()->GetValueProvider($controllerContext);

		foreach($method->getParameters() as $parameter) {
			$parms[] = ModelBinders::GetBinders()->GetBinder($parameter->GetClass())->BindModel($controllerContext,new ModelBindingContext($valueProvider));
		}

		return $parms;
	}

	public static function Bind2(HttpRequest $request, \ReflectionMethod $method) {
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

		return array('customer' => new \MyApp\Models\Customer(new Integer(1), new String('freek')));

		// return $params;
	}
}