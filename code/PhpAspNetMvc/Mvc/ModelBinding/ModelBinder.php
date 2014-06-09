<?php

namespace PhpAspNetMvc\Mvc\ModelBinding;

use PhpAspNetMvc\Http\HttpContext;
use PhpAspNetMvc\Types\Integer;
use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Mvc\ModelBinders;
use PhpAspNetMvc\Mvc\ModelBindingContext;
use PhpAspNetMvc\Mvc\ControllerContext;
use PhpAspNetMvc\Mvc\ValueProviderFactories;

class ModelBinder {
	public static function Bind(HttpContext $context, \ReflectionMethod $method)  {
		$parms = array();

		$controllerContext = new ControllerContext($context);

		$valueProvider = ValueProviderFactories::GetFactories()->GetValueProvider($controllerContext);

		foreach($method->getParameters() as $parameter) {
			$modelBindingContext = new ModelBindingContext($valueProvider, $parameter->getClass(), new String($parameter->name));
			$parms[] = ModelBinders::GetBinders()->GetBinder($parameter->GetClass())->BindModel($controllerContext,$modelBindingContext);
		}

		return $parms;
	}
}