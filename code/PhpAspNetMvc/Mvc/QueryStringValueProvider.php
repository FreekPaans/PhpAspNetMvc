<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class QueryStringValueProvider implements IValueProvider {
	private $_queryString;

 	public function __construct(ControllerContext $context){
 		$this->_queryString = $context->getHttpContext()->getHttpRequest()->GetQueryString();
 	}

	public function ContainsPrefix(String $prefix) {
		$prefix = $prefix->Append(new String('.'));
		return $this->_queryString->GetAllKeys()->Filter(function(String $key) use($prefix) { return $key->StartsWith($prefix) ;} )->Any();
	}

	public function GetValue(String $key) {
		if($this->_queryString->TryGetValue((string)$key, $value)===true) {
			return $value;
		}
		return null;
	}
}