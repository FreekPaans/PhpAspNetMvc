<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;

class DefaultModelBinder implements IModelBinder {
	public function BindModel(ControllerContext $controllerContext, ModelBindingContext $bindingContext) {
		$converters = self::getTypeConverters();

		$typeKey = $bindingContext->GetModelType()->getName();

		$value = $bindingContext->GetValueProvider()->GetValue($bindingContext->GetModelName());

		if(array_key_exists($typeKey, $converters)) {
			if($value===null) {
				return null;
			}
			return $converters[$typeKey]($value);
		}


		if(!$bindingContext->GetValueProvider()->ContainsPrefix($bindingContext->GetModelName())) {
			return null;
		}

		return $this->BindComplexModel($controllerContext, $bindingContext);		
	}

	private function BindComplexModel(ControllerContext $controllerContext, ModelBindingContext $bindingContext) {
		$ctor = $bindingContext->GetModelType()->getConstructor();

		$ctorParamValues = array();
		$ctorParamKeyValue = array();

		foreach($ctor->getParameters() as $param) {
			$newBindingContext = $bindingContext->ForNewParameter($bindingContext->GetModelName()->Append(new String("."))->Append(new String($param->getName())), $param->getClass());;
			$model = $this->BindModel($controllerContext,$newBindingContext);
			$ctorParamValues[] = $model;
			$ctorParamKeyValue[$param->getName()] = $model;
		}

		$result = $bindingContext->GetModelType()->newInstanceArgs($ctorParamValues);

		$refObject = new \ReflectionObject($result);

		
		foreach($ctorParamKeyValue as $key=>$value) {
			if($refObject->hasProperty($key)) {
				continue;
			}
	
			$result->$key = $value;
		}

		return $result;
		
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